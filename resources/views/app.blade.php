<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}" />
        <!-- Font-awesome CSS -->
        <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
        <!-- jquery JS -->
        <script src="{{ asset('toastr/jquery-2.1.1.min.js') }}" type="text/javascript"></script>
        <!-- Toastr JS -->
        <script src="{{ asset('toastr/toastr.min.js') }}" type="text/javascript"></script>
        <!-- Toastr CSS -->
        <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}" type="text/css"/>
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
