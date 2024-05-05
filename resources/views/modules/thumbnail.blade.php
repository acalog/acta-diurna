
<img src="{{ Storage::disk('s3')->temporaryUrl($imgSource . '.jpg', now()->addMinutes(5)) }}" class="img-thumbnail" alt="{{ $caption ?? '' }}">

@if(isset($caption))
    <h4 class="text-center img_text">{{ $caption }}</h4>
@endif
