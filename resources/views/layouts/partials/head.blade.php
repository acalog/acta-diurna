<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#F31561"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (Cookie::get('theme') == 'light')
        <style>
            .light {
                background-image: url({{ Storage::disk('s3')->url('assets/westfieldmapview.jpg') }});
                background-position: 50% 20%;
                color: #000000FF;
                animation-name: slide;
                animation-duration: 400s;
                animation-iteration-count: infinite;
                animation-delay: 1s;
            }
        </style>
    @endif


    <!-- Title -->
    <title>@yield('title', config('app.name'))</title>

    <!-- Check if browser has javascript -->
    <script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>

    <!-- Scripts -->
    <script src="{{ asset('/static/js/app.js') }}"></script>
    <script src="{{ asset('/static/js/main.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/3a7de25058.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('/static/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/static/css/fonts.css') }}" rel="stylesheet">

</head>
