<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    {{--<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>--}}
    {!! Meta::toHtml() !!}

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/mail.css', 'resources/js/mail.js'])
    @stack('css')
</head>
<body class="text-xl md:text-sm text-gray-500 dark:text-white bg-gray-50 dark:bg-gray-800">
    <section class="max-w-2xl px-6 py-8 mx-auto bg-gray-100 dark:bg-gray-900 shadow-xl">
        <header>
            <a href="{{ url('/') }}" target="_blank">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-auto mx-auto h-14 sm:h-16">
            </a>
        </header>

        <main class="mt-8">
            {{ $slot }}
        </main>

        <footer class="mt-6 text-center border-t">
            <div class="mt-2 text-gray-500 dark:text-gray-400 flex flex-col gap-2">
                <div>{{ env('TTF_NAME') }}</div>
                <div>{{ env('TTF_STRASSE') }}</div>
                <div>{{ env('TTF_ORT') }}</div>
                <div class="mt-4">{{ env('TTF_EMAIL') }}</div>
            </div>
            <p class="mt-3 text-gray-500 dark:text-gray-400">&copy; 2023 {{ env('TTF_NAME') }}. Alle Rechte vorbehalten.</p>
        </footer>
    </section>
    @stack('js')
    @stack('scripts')
</body>
</html>
