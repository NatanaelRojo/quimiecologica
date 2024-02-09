<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />

        <!-- Font-awesome CSS -->
        <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        {{-- @vite('resources/js/app.js') --}}
        @inertiaHead
    </head>
    <body class="gradient leading-relaxed tracking-wide flex flex-col font-sans antialiased">
        @inertia
    </body>
</html>
