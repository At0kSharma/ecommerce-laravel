<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gurkha Trails</title>
    @include('layouts.header')
    @livewireStyles
</head>
<body>
    @include('layouts.navbar')
    
    @yield('content')
   
    @include('layouts.footer')
    @livewireScripts
</body>
</html>
