<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        {{--<meta charset="utf-8">--}}
        {{--<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}
        {!! Meta::toHtml() !!}
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">--}}
        @laravelPWA
        <!-- Include meta.blade.php -->
        @stack('meta')
        <!-- Include CSS Files -->
        @stack('css')
    </head>
    <body class="bg-gray-50 dark:bg-gray-800 text-sm text-gray-500 dark:text-white">
    <div class="flex flex-col h-screen justify-between">
        @if(false)
            @guest
            @else
                @include('layouts.partials.banner')
            @endguest
        @endif
        @include('layouts.partials.navigation')
        <main class="mb-auto">
            {{ $slot }}
        </main>
        @include('layouts.partials.footer')
        <x-custom.back-to-top/>
    </div>
{{--    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>--}}
    @stack('js')
    @stack('scripts')
    </body>
</html>
