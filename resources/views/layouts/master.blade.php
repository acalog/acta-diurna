<!DOCTYPE html>

<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
</head>
<!-- If it is a guest user, use cookies to set theme. -->
<body class="{{ is_null(Cookie::get('theme')) ? 'seasonal' : Cookie::get('theme') }}">
    <!-- Alerts -->
    @if(session('alert'))
        <div class="alert-success">
            <span class="alert-text">{{ session('alert') }}</span>
        </div>
    @endif
    <!-- Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Navbar -->
    @include('nav.navbar')

    <!-- Global Modals -->
    @include('modules.change-theme')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts.partials.footer')
</body>
</html>
