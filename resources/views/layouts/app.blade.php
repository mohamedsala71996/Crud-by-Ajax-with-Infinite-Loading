<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">


        @stack('styles')

        

        <title>{{ $title ?? 'Task' }}</title>
    </head>
    <body>


        @yield('content')
        

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>


        @stack('scripts')


    </body>

</html>
