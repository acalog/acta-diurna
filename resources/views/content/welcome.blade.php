@extends('layouts.master')

@section('title', 'Nightmare Houses')

@section('content')
    <div class="container-fluid">
        <h1 class="post-title">Welcome to Nightmare Houses.<br><br>America’s most notorious real estate.</h1>

        <div class='row'>
            <div class='col-lg-4'>

            </div>
            <div class='col-lg-4'>
                <a href="{{ url('/podcasts') }}">
                    @include('modules.thumbnail', ['imgSource' => 'NightmareHousesLogo', 'caption' => 'Nightmare Houses Podcast'])
                </a>
            </div>
            <div class='col-lg-4'>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <a href="{{ url('/highfields') }}">
                    @include('modules.figure', ['imgSource' => '1', 'caption' => 'Highfields'])
                </a>
            </div>

            <div class="col-lg-6">
                <a href="{{ url('/thewatcher') }}">
                    @include('modules.figure', ['imgSource' => 'watcher1_4-3b', 'caption' => 'The Watcher'])
                </a>
            </div>

        </div>

    </div>
@endsection
