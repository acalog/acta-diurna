<div class="episode-container">
    @isAdmin
        <div class="episode-item">
            <a href="{{ route('podcasts.edit', $podcast->id) }}" class="admin-item">Edit Podcast</a>
        </div>
    @endisAdmin
    <div class="episode-item">
        <a href="{{ route('getPodcast', "s" . $podcast->season . "e" . $podcast->episode) }}">
            <h2>S{{ $podcast->season }} E{{ $podcast->episode }} - {{ $podcast->title }} </h2>
        </a>
    </div>

    <div class="episode-item">
        <a href="{{ route('getPodcastBySlug', Str::lower(str_replace(' ', '_', $podcast->title))) }}">
            <h2>S{{ $podcast->season }} E{{ $podcast->episode }} - {{ $podcast->title }} </h2>
        </a>
    </div>

    <div class="episode-item-container">
        <div class="episode-inner-container">
            <div class="episode-item-image">
                <a href="{{ url('/podcasts/' . $podcast->id) }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => $podcast->thumbnail])
                </a>
            </div>
            <div class="episode-item">
                <iframe src="https://player.rss.com/nightmarehouses/{{ $podcast->rss }}?theme=light" style="width: 100%"
                        title="Nightmare Houses" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen><a
                        href="https://rss.com/podcasts/nightmarehouses/{{ $podcast->rss }}">{{ $podcast->title }} |
                        RSS.com</a></iframe>
            </div>
        </div>
    </div>
    <div class="episode-item">
        <p>{{ $podcast->description }}</p>
    </div>
    <div class="episode-item-container" id="bottom-row">
        <div class="episode-inner-container">
            <div class="episode-item">
                By The Narrator
            </div>
            <div class="episode-item">
                {{ $podcast->published->format('F jS, Y') }}
            </div>
        </div>
    </div>
</div>
