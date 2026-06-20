<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Nawasena CRM') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Inter', sans-serif; }

            /* Base fade-in */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(16px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in { animation: fadeInUp 0.4s ease-out both; }

            /* Staggered stat cards */
            .stat-card {
                opacity: 0;
                animation: fadeInUp 0.5s ease-out forwards;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .stat-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(38, 49, 69, 0.08);
            }
            .stat-card:nth-child(1) { animation-delay: 0.05s; }
            .stat-card:nth-child(2) { animation-delay: 0.12s; }
            .stat-card:nth-child(3) { animation-delay: 0.19s; }
            .stat-card:nth-child(4) { animation-delay: 0.26s; }

            /* Filter bar slide-in */
            .filter-bar {
                opacity: 0;
                animation: fadeInUp 0.45s ease-out 0.3s forwards;
            }

            /* Table container */
            .table-container {
                opacity: 0;
                animation: fadeInUp 0.45s ease-out 0.4s forwards;
            }

            /* Table row hover */
            .table-row {
                transition: background-color 0.15s ease, transform 0.15s ease;
            }
            .table-row:hover {
                background-color: #F3F7FF;
            }

            /* Slide-in for table rows */
            @keyframes slideInRight {
                from { opacity: 0; transform: translateX(-12px); }
                to { opacity: 1; transform: translateX(0); }
            }
            .table-row { animation: slideInRight 0.3s ease-out both; }
            .table-row:nth-child(1) { animation-delay: 0.05s; }
            .table-row:nth-child(2) { animation-delay: 0.08s; }
            .table-row:nth-child(3) { animation-delay: 0.11s; }
            .table-row:nth-child(4) { animation-delay: 0.14s; }
            .table-row:nth-child(5) { animation-delay: 0.17s; }
            .table-row:nth-child(6) { animation-delay: 0.20s; }
            .table-row:nth-child(7) { animation-delay: 0.23s; }
            .table-row:nth-child(8) { animation-delay: 0.26s; }
            .table-row:nth-child(9) { animation-delay: 0.29s; }
            .table-row:nth-child(10) { animation-delay: 0.32s; }

            /* Button hover lift */
            .btn-hover {
                transition: background-color 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
            }
            .btn-hover:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 8px rgba(38, 49, 69, 0.12);
            }
            .btn-hover:active {
                transform: translateY(0);
                box-shadow: none;
            }

            /* Badge pulse on hover */
            .badge-hover {
                transition: transform 0.2s ease, background-color 0.2s ease;
            }
            .badge-hover:hover {
                transform: scale(1.05);
            }

            /* Stat number counter effect */
            .stat-number {
                display: inline-block;
                transition: transform 0.2s ease;
            }
            .stat-card:hover .stat-number {
                transform: scale(1.05);
            }

            /* Smooth input focus */
            input, select, textarea {
                transition: border-color 0.2s ease, box-shadow 0.2s ease, background-color 0.15s ease;
            }

            /* Flash message */
            @keyframes flashIn {
                0% { opacity: 0; transform: translateY(-8px) scale(0.98); }
                100% { opacity: 1; transform: translateY(0) scale(1); }
            }
            .flash-msg { animation: flashIn 0.4s ease-out both; }

            /* Link underline animation */
            .link-animated {
                position: relative;
                transition: color 0.2s ease;
            }
            .link-animated::after {
                content: '';
                position: absolute;
                width: 0;
                height: 1px;
                bottom: -1px;
                left: 0;
                background-color: #FAB95B;
                transition: width 0.25s ease;
            }
            .link-animated:hover::after {
                width: 100%;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-nw-light text-gray-900">
        <div class="min-h-screen">
            @include('layouts.navigation')
            @isset($header)
                <header class="bg-white border-b border-gray-200">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset
            <main class="animate-fade-in">
                {{ $slot }}
            </main>
        </div>
        @stack('scripts')
    </body>
</html>
