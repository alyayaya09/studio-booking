<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Framehaus') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=cormorant-garamond:500,600|hanken-grotesk:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --wine-deep: #22090f;
                --wine: #34121b;
                --wine-soft: #4a1d29;
                --champagne: #d8b48e;
                --champagne-soft: #ead3b8;
                --ivory: #f4eadf;
                --mauve: #b39499;
                --line: rgba(216, 180, 142, .22);
                --display: 'Cormorant Garamond', 'Georgia', serif;
                --body: 'Hanken Grotesk', 'Helvetica Neue', Arial, sans-serif;
            }

            body {
                font-family: var(--body);
                background: var(--wine-deep);
                color: var(--ivory);
            }

            .app-header {
                background: var(--wine);
                border-bottom: 1px solid var(--line);
            }

            .app-header h2 {
                font-family: var(--display);
                font-size: 1.75rem;
                font-weight: 600;
                color: var(--champagne-soft);
            }

            /* Kartu & elemen bersama */
            .card {
                background: var(--wine);
                border: 1px solid var(--line);
                border-radius: .75rem;
                padding: 1.5rem;
            }

            .card h3,
            .card h4 {
                font-family: var(--display);
                color: var(--champagne-soft);
                font-weight: 600;
            }

            .card h3 { font-size: 1.5rem; }
            .card h4 { font-size: 1.25rem; }

            .card label { color: var(--champagne-soft); }

            .card input,
            .card select,
            .card textarea {
                background: var(--wine-deep);
                color: var(--ivory);
                border-color: var(--line);
                color-scheme: dark;
            }

            .card input:focus,
            .card select:focus,
            .card textarea:focus {
                border-color: var(--champagne);
                box-shadow: 0 0 0 1px var(--champagne);
            }

            .card button[type="submit"] {
                background: var(--champagne);
                color: var(--wine-deep);
            }

            .card button[type="submit"]:hover {
                background: var(--champagne-soft);
            }

            .muted { color: var(--mauve); }
            .gold { color: var(--champagne); }

            .pkg {
                background: var(--wine-soft);
                border: 1px solid var(--line);
                border-radius: .5rem;
                padding: 1rem;
            }

            .alert-success {
                background: rgba(216, 180, 142, .12);
                border: 1px solid var(--line);
                color: var(--champagne-soft);
                border-radius: .5rem;
                padding: 1rem;
                font-size: .875rem;
            }

            /* Kotak dropdown profil */
            .dropdown-lux {
                background: var(--wine-soft);
                border: 1px solid var(--line);
                border-radius: .5rem;
            }

            .dropdown-lux a,
            .dropdown-lux button {
                color: var(--champagne-soft);
            }

            .dropdown-lux a:hover,
            .dropdown-lux a:focus,
            .dropdown-lux button:hover,
            .dropdown-lux button:focus {
                background: var(--wine);
                color: var(--ivory);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="app-header">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>