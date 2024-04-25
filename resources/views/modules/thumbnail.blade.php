@if(\Illuminate\Support\Str::contains($imgSource, '.jpg'))
    <img width="150" height="150" src="{{ asset('storage/assets/' . $imgSource) }}" alt="{{ $caption ?? '' }}">

@else
    <img width="150" height="150" src="{{ asset('storage/assets/' . $imgSource . '.jpg') }}" alt="{{ $caption ?? '' }}">
@endif

@if(isset($caption))
    <h4 class="text-center img_text">{{ $caption }}</h4>
@endif
