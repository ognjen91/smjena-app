<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- for FF, Chrome, Opera -->
    <link rel="icon" type="image/png" href="/assets/logo-white.png" sizes="16x16">
    <link rel="icon" type="image/png" href="/assets/logo-white.png" sizes="32x32">

    <!-- for IE -->
    <link rel="icon" type="image/x-icon" href="/assets/logo.ico" >
    <link rel="shortcut icon" type="image/x-icon" href="/assets/logo.ico"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name_public', 'Smjena-App') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC|Julius+Sans+One&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <v-app id="app" class="guestApp">
            @yield('content')
    </v-app>
</body>
</html>
