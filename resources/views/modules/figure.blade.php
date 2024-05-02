<figure>
    <img src="{{ Storage::disk('s3')->url($imgSource . '.jpg') }}" class="img-thumbnail" alt="{{ $caption ?? '' }}">

    @if(isset($caption))
        <figcaption>
            {{ $caption }}@if(isset($link)) <a href="{{ $link }}">{{ $linkText ?? '' }}</a>@endif
        </figcaption>
    @endif
</figure>
