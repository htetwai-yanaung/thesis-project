<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <link rel="stylesheet" href="{{ asset( 'css/bootstrap.min.css' ) }}">
        <script src="{{ asset( 'js/bootstrap.min.js' ) }}"></script>

    </head>
    <body class="container-fluid">
        <div class="row">
            <div class="col">
                @yield('content')
            </div>
            <div class="col vh-100">
                <img src="{{ asset('images/login.png') }}" class="w-100 h-100 img-fluid" alt="">
            </div>
        </div>
    </body>
</html>
