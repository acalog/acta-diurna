<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Panel\HomeController;
use App\Podcast;
use Facades\App\Repository\Videos;
use Log;
use Illuminate\Http\Request;
use Cookie;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    public function index()
    {
        Log::info(log_client());

        Log::info(Cookie::get('theme'));
        if (is_null(Cookie::get('theme')))
        {
            Cookie::queue(Cookie::make('theme', 'light', 300));
        }
        else
        {
            Cookie::queue('theme', Cookie::get('theme'), 300);
        }

        return view('content.welcome');
    }

    public function getArticle(String $title)
    {
        if (is_null(Cookie::get('theme')))
        {
            Cookie::queue(Cookie::make('theme', 'light', 300));
        }
        else
        {
            Cookie::queue('theme', Cookie::get('theme'), 300);
        }

        return view("content.{$title}.{$title}");
    }

    public function getPodcast(String $title)
    {
        /*


        if ($request->is('login'))
        {
            return view("content.auth.login");
        }
        */


        if (is_null(Cookie::get('theme')))
        {
            Cookie::queue(Cookie::make('theme', 'light', 300));
        }
        else
        {
            Cookie::queue('theme', Cookie::get('theme'), 300);
        }
        $podcast = Podcast::where([
            ['title', Str::title(str_replace('_', ' ', $title))],
        ])->first();


        return view('content.podcast.index')->with(['podcast' => $podcast]);
        // return view("content.podcast.{$title}.{$title}");

        // New Version

    }

    public function get(String $title)
    {

        preg_match('/s(\d)e(\d{1,2})/', $title, $target);

        // dd($target);

        $season = $target[1];
        $episode = $target[2];

        $podcast = Podcast::where([
            ['episode', $episode],
            ['season', $season],
            ])->first();

        // Return podcast page with data
        return view('content.podcast.index')->with(['podcast' => $podcast]);
    }

    public function references(String $title)
    {
        preg_match('/s(\d)e(\d{1,2})/', $title, $target);

        // dd($target);

        $season = $target[1];
        $episode = $target[2];

        $podcast = Podcast::where([
            ['episode', $episode],
            ['season', $season],
        ])->first();

        return view('content.podcast.references')->with(['podcast' => $podcast]);

    }

    public function getPodcasts()
    {
        $podcasts = Podcast::where('rss', '!=', 'Pending')->get()->sortByDesc('published');

        return view('content.podcast.directory')->with(['podcasts' => $podcasts]);
    }





    public function changeTheme(Request $request)
    {
        $theme = $request->input('theme');
        if (is_null(Cookie::get('theme')))
        {
            Cookie::queue(Cookie::make('theme', $theme, 300));
        }
        else
        {
            Cookie::queue('theme', $theme, 300);
        }
        return redirect()->back();
    }
}
