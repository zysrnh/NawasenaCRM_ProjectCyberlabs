<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Nawasena CRM') }} - Login</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
            .animate-fade-in { animation: fadeIn 0.4s ease-out both; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-nw-light">

        <div class="h-1 bg-gold w-full absolute top-0 left-0"></div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-10 sm:pt-0">
            <div class="animate-fade-in mb-6">
                <a href="/">
                    <img src="{{ asset('img/nawasena-logo-white.png') }}" alt="Nawasena" class="h-14 bg-navy p-3 rounded">
                </a>
            </div>

            <div class="animate-fade-in w-full sm:max-w-md px-6 py-8 bg-white border border-gray-200 shadow-sm overflow-hidden sm:rounded" style="animation-delay: 0.1s;">
                <div class="mb-6 text-center">
                    <h2 class="text-xl font-bold text-navy">Admin Login</h2>
                    <p class="text-sm text-nw-body mt-1">Masuk ke dashboard CRM Nawasena</p>
                </div>

                {{ $slot }}
            </div>

            <div class="mt-8 text-center animate-fade-in" style="animation-delay: 0.2s;">
                <p class="text-xs text-gray-400">&copy; {{ date('Y') }} Nawasena. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
