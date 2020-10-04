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
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>
    </head>
    <body class="antialiased">
        <nav class="w-full h-16 px-3 sm:px-6 lg:px-8 border-t-4 border-blue-700 shadow-md">
            <div class="max-w-7xl mx-auto flex justify-between items-center ">
                <div>
                    <a href="{{ route('programs.index') }}" class="text-4xl font-extrabold font-mono">
                        Prolog
                    </a>
                </div>
                <div>

                </div>
            </div>
        </nav>
        <div class="font-sans text-gray-900 px-3 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
        @livewireScripts
    </body>
</html>
