<img src="{{ Storage::disk('s3')->url($imgSource) }}" class="img-thumbnail" alt="{{ $caption ?? '' }}">

@if(isset($caption))
    <h4 class="text-center img_text">{{ $caption }}</h4>
@endif
