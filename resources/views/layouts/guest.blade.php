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

            .gl-page {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 2rem 1rem;
                background:
                    radial-gradient(circle at 50% 0%, rgba(216, 180, 142, .16), transparent 55%),
                    var(--wine-deep);
            }

            .gl-brand { text-align: center; margin-bottom: 1.75rem; }
            .gl-brand a { display: inline-block; text-decoration: none; }
            .gl-logo { width: 4rem; height: 4rem; fill: currentColor; color: var(--champagne); }
            .gl-eyebrow {
                margin-top: .75rem;
                font-size: .75rem;
                letter-spacing: .35em;
                text-transform: uppercase;
                color: var(--champagne);
            }
            .gl-divider {
                width: 90px;
                height: 1px;
                margin: 1rem auto 0;
                background: linear-gradient(90deg, transparent, var(--champagne), transparent);
            }

            .gl-card {
                width: 100%;
                max-width: 28rem;
                padding: 2rem;
                border-radius: 1rem;
                border: 1px solid var(--line);
                background: linear-gradient(160deg, var(--wine-soft), var(--wine));
                box-shadow: 0 14px 40px rgba(0, 0, 0, .35);
            }

            /* Menimpa gaya komponen Breeze di dalam kartu */
            .gl-card label.block {
                display: block;
                margin-bottom: .5rem;
                font-size: .7rem;
                font-weight: 500;
                letter-spacing: .25em;
                text-transform: uppercase;
                color: var(--champagne);
            }
            .gl-card input:not([type="checkbox"]):not([type="radio"]) {
                display: block;
                width: 100%;
                padding: .85rem 1rem;
                border-radius: .6rem;
                border: 1px solid var(--line);
                background-color: var(--wine-deep);
                color: var(--ivory);
                color-scheme: dark;
                font-size: 1rem;
                box-shadow: none;
            }
            .gl-card input:not([type="checkbox"]):not([type="radio"]):focus {
                outline: none;
                border-color: var(--champagne);
                box-shadow: 0 0 0 1px var(--champagne);
            }
            .gl-card input::placeholder { color: var(--mauve); opacity: .6; }
            .gl-card input[type="checkbox"] {
                width: 1.1rem;
                height: 1.1rem;
                accent-color: var(--champagne);
                cursor: pointer;
            }

            .gl-card .text-gray-600,
            .gl-card .text-gray-500 { color: var(--mauve); }
            .gl-card .text-gray-700,
            .gl-card .text-gray-900 { color: var(--champagne-soft); }
            .gl-card .text-red-600,
            .gl-card .text-red-500 { color: #f4a6a6; }
            .gl-card .text-green-600 { color: #a9dcb8; }

            .gl-card a {
                color: var(--champagne);
                text-decoration: underline;
                text-underline-offset: 3px;
                transition: color .2s ease;
            }
            .gl-card a:hover { color: var(--champagne-soft); }

            .gl-card button {
                padding: .9rem 1.5rem;
                border: 0;
                border-radius: .6rem;
                cursor: pointer;
                font-family: var(--body);
                font-size: .78rem;
                font-weight: 600;
                letter-spacing: .25em;
                text-transform: uppercase;
                color: var(--wine-deep);
                background: linear-gradient(135deg, var(--champagne-soft), var(--champagne));
                transition: transform .2s ease, box-shadow .2s ease;
            }
            .gl-card button:hover {
                transform: translateY(-2px);
                box-shadow: 0 12px 28px rgba(216, 180, 142, .25);
            }

            @media (max-width: 480px) {
                .gl-page { padding: 1.25rem .75rem; }
                .gl-brand { margin-bottom: 1.25rem; }
                .gl-logo { width: 3rem; height: 3rem; }
                .gl-card { padding: 1.25rem; border-radius: .8rem; }
                .gl-card input:not([type="checkbox"]):not([type="radio"]) { padding: .65rem .85rem; }
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="gl-page">
            <div class="gl-brand">
                <a href="/">
                    <x-application-logo class="gl-logo" />
                    <div class="gl-eyebrow">Framehaus Studio</div>
                </a>
                <div class="gl-divider"></div>
            </div>

            <div class="gl-card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>