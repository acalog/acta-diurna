<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Podcast;
use App\Image;
use App\Reference;
use App\Services\Formatter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PodcastController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $podcasts = Podcast::all()->sortByDesc('id');

        return view('content.podcast.directory')->with(['podcasts' => $podcasts]);

    }


    public function panelIndex()
    {
        $podcasts = Podcast::all()->sortByDesc('id');

        return view('panel.index')->with(['podcasts' => $podcasts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        dump(1);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {

        $title       = $request->input('title');
        $description = $request->input('description');
        $published   = $request->input('published');
        $season      = $request->input('season');
        $episode     = $request->input('episode');
        $rss         = $request->input('rss', 'Pending');
        $thumbnail   = $request->file('uploadFile');
        $pending     = $request->boolean('draft');
        $filename    = Str::snake($request->input('title') . '_title');

        Storage::disk('s3')->putFileAs('', $thumbnail, $filename . '.jpg');

        $podcast = Podcast::create([
            'title' => $title,
            'description' => $description,
            'published' => $published,
            'season' => $season,
            'episode' => $episode,
            'rss' => $rss ?? 'Pending',
            'thumbnail' => $filename
        ]);

        $image = Image::create([
            'filename' => $filename
        ]);

        $image->podcast()->associate($podcast);
        $image->save();

        return redirect()->route('podcasts.edit', $podcast->id)->with(['alert' => 'New Episode Added.']);
    }

    /**
     * Display the specified resource.
     *
     * @param Podcast $podcast
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show(Podcast $podcast)
    {
        return view('panel.edit')->with(['podcast' => $podcast]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Podcast $podcast
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(Podcast $podcast)
    {
        return view('panel.edit')->with(['podcast' => $podcast]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Podcast $podcast
     * @return RedirectResponse
     */
    public function update(Request $request, Podcast $podcast)
    {
        // $path = $request->file('uploadFile')[1]->store('public/assets');

        // Update the Thumbnail Image
        if ($request->hasFile('uploadThumbnailFile'))
        {
            $file = $request->file('uploadThumbnailFile');

            // $path = $file->storeAs('public/assets', $file->getClientOriginalName());
            //dd($file);

            // Delete Old Thumbnail
            // $old_thumbnail = Image::where('filename', $podcast->thumbnail)->first();

            // Image::destroy($old_thumbnail->id);

            // $path = $file->storeAs('public/assets', Str::snake($podcast->title . '_title' . '.jpg'));
            $filePath = Str::snake($podcast->title . '_title') . '.jpg';
            // Storage::disk('s3')->delete($filePath);
            if (Storage::disk('s3')->delete($filePath))
            {
                Storage::disk('s3')->putFileAs('', $file, $filePath);
            }

            // Save Image metadata
            /*
            $image = Image::create([
                'filename' => $podcast->thumbnail
            ]);

            // Associate with podcast
            $image->podcast()->associate($podcast);
            $image->save();
            */
        }

        if ($request->has('description'))
        {
            $podcast->description = $request->input('description');
            $podcast->save();
        }

        // dump($request->files('uploadFile')->store('public/assets'));

        // associate with podcast
        return redirect()->route('podcasts.edit', $podcast->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Podcast $podcast
     * @return RedirectResponse
     */
    public function destroy(Podcast $podcast)
    {

        $image_ids = $podcast->images->pluck('id');

        Image::destroy($image_ids);
        Podcast::destroy($podcast->id);
        return redirect()->route('panel');
    }

    /**
     * Update the resource's associated image
     *
     * @param \App\Image  $image
     * @return Response|void
     */
    public function updateImage(Request $request, Image $image)
    {
        return;
    }


    /**
     * Set podcast resource to published (public)
     *
     * @param Request $request
     * @param Podcast $podcast
     * @return RedirectResponse
     */
    public function publish(Request $request, Podcast $podcast)
    {
        $rss = $request->input('rss');
        $podcast->rss = $rss;
        $podcast->save();
        return redirect()->route('panel');
        // return redirect(route('panel'));
    }

    /**
     * Save a new Reference
     *
     * @param Request $request
     * @param Podcast $podcast
     * @return RedirectResponse
     */
    public function storeReference(Request $request, Podcast $podcast): RedirectResponse
    {
        $label = $request->input('reference');

        $url = Formatter::url_shortcode($label);

        $url = str_replace('""', '"', $url);

        $pattern = '/(?<!https:\/\/)(www\.[^\r\n\t\f\v"][^"]+)/i';
        $callback = function ($matches) {
            // Prepend "http://" to the URL.
            return 'https://' . $matches[1];
        };
        $url = preg_replace_callback($pattern, $callback, $url);

        $reference = Reference::create([
            'label' => $label,
            'url' => $url
        ]);

        // Associate with podcast
        $reference->podcast()->associate($podcast);
        $reference->save();

        return redirect()->route('podcasts.edit', $podcast->id);

    }




}
