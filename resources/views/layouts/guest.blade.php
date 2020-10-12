<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>
    </head>
    <body class="antialiased min-h-screen flex flex-col">

        <div class="flex-none">
            <x-toaster :message="session('ok')" />

            @livewire('navigation-dropdown')
        </div>

        <div class="flex-grow font-sans text-gray-900 px-3 sm:px-6 lg:px-8 mt-8">
            <x-guest-alert />
            {{ $slot }}
        </div>

        <footer class="w-full flex-none px-3 sm:px-6 lg:px-8 mt-6">
            <div class="max-w-7xl mx-auto flex justify-between items-center ">
                <div></div>
                <div>
                    <span class="font-mono font-bold text-sm">app code on </span>
                    <a class="font-mono font-bold" href="https://github.com/opmvpc/prolog">GitHub</a>
                </div>
            </div>
        </footer>

        @stack('modals')
        @livewireScripts

    </body>
</html>
