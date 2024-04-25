@extends('layouts.master')

@section('title', 'Nightmare Houses Podcast')

@section('content')
    <div class="container-fluid">
        <h1 class="post-title">Welcome to Nightmare Houses Podcast.</h1>
        @include('modules.figure', ['imgSource' => 'NightmareHousesLogo'])

        <div class="row">
            @include('nav.external-links')
        </div>
        <div class="row">
            @include('modules.audio-player')   
        </div>
        
        {{-- @include('modules.external-links') --}}
        
        @foreach($podcasts as $podcast)
            @include('modules.episode', ['podcast' => $podcast])
        @endforeach
        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', 'losfeliz') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => 'The_Los_Angeles_Times_Sun__Dec_4__1932_ (1)', 'caption' => 'S01 E08: The Los Feliz Mystery House'])
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', 'turpin') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => '5b816b9fc1d676e988478e2493bf6d36-uncropped_scaled_within_1536_1152', 'caption' => 'S01 E07: The Turpin Family Home'])
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', 'lindbergh') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => 'highfields', 'caption' => 'S01 E06: Lindbergh\'s Baby Kidnapping'])
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', 'menendez') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => 'menendez-home-in-beverly-hills-1505921806', 'caption' => 'S01 E05: Menendez Brothers Murder House'])
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', 'breezeknoll') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => '431HillsideAve', 'caption' => 'S01 E04: Breezeknoll'])
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', 'watts') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => 'watts', 'caption' => 'S01 E03: The Watts Family Home'])
                </a>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', '3301waverly') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => 'LaBianca_residence_in_Los_Feliz_Thumb', 'caption' => 'S01 E02: 3301 Waverly Drive'])
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mx-auto my-5">
                <a href="{{ route('podcast', '10050cielo') }}" class="text-decoration-none">
                    @include('modules.thumbnail', ['imgSource' => '10050cielo512', 'caption' => 'S01 E01: 10050 Cielo Drive'])
                </a>
            </div>
        </div>

    </div>
@endsection

