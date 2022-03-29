@extends('layouts.master')

@section('title', 'Nightmare Houses Podcast')

@section('content')
    <div class="container-fluid">
        <h1 class="post__title">Welcome to Nightmare Houses Podcast.</h1>
        <audio
                controls
                src={{ asset('storage/media/NightmareHouses_Intro_Master.mp3/') }}>
            Your browser does not support the
            <code>audio</code> element.
        </audio>
        <div class='row'>
            <div class='col-lg-4'>
                <a href="{{ url('/10050cielo') }}">
                    @include('modules.figure', ['imgSource' => '10050cielo512', 'caption' => 'S1 E1: 10050 Cielo Drive'])
                </a>
            </div>
        </div>

    </div>
@endsection

