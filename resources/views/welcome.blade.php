<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Framehaus Studio</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Hanken+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">

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

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            margin: 0;
            color: var(--ivory);
            font-family: var(--body);
            font-weight: 300;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            background:
                radial-gradient(60rem 40rem at 85% -5%, rgba(74, 29, 41, .85), transparent 60%),
                radial-gradient(50rem 36rem at -10% 60%, rgba(52, 18, 27, .9), transparent 65%),
                var(--wine-deep);
            background-attachment: fixed;
        }

        /* fine film grain for a printed-paper feel */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            opacity: .07;
            background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='160' height='160'><filter id='n'><feTurbulence type='fractalNoise' baseFrequency='.9' numOctaves='2' stitchTiles='stitch'/></filter><rect width='100%' height='100%' filter='url(%23n)'/></svg>");
        }

        a { color: inherit; text-decoration: none; }
        a:focus-visible, button:focus-visible {
            outline: 2px solid var(--champagne);
            outline-offset: 4px;
        }

        .wrap {
            position: relative;
            z-index: 1;
            width: min(1180px, 100% - 3rem);
            margin-inline: auto;
        }

        /* ---------- Nav ---------- */
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-block: 1.75rem;
        }
        .brand {
            font-family: var(--display);
            font-weight: 500;
            font-size: 1.5rem;
            letter-spacing: .01em;
            color: var(--champagne-soft);
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.9rem;
            font-size: .95rem;
        }
        .nav-links a { color: var(--mauve); transition: color .2s; }
        .nav-links a:hover { color: var(--ivory); }
        .nav-links .nav-cta {
            color: var(--champagne-soft);
            border: 1px solid rgba(216, 180, 142, .5);
            padding: .55rem 1.35rem;
            border-radius: 999px;
        }
        .nav-links .nav-cta:hover { background: var(--champagne); color: var(--wine-deep); }

        /* ---------- Hero ---------- */
        .hero {
            display: grid;
            grid-template-columns: 1.1fr .9fr;
            align-items: center;
            gap: clamp(2rem, 6vw, 6rem);
            padding-block: clamp(2rem, 6vh, 4.5rem) clamp(4.5rem, 10vh, 8rem);
            min-height: calc(100vh - 6rem);
        }

        .hero-title {
            font-family: var(--display);
            font-weight: 500;
            font-size: clamp(2.5rem, 4.8vw, 4.2rem);
            line-height: 1.05;
            letter-spacing: -.015em;
            margin: 0 0 1.9rem;
            color: var(--ivory);
        }
        .hero-title .second {
            display: block;
            font-style: italic;
            font-weight: 400;
            color: var(--champagne);
        }

        .hero-lead {
            max-width: 27rem;
            margin: 0 0 2.6rem;
            font-size: 1rem;
            color: var(--mauve);
        }

        .actions { display: flex; flex-wrap: wrap; align-items: center; gap: 1.75rem; }

        .btn {
            display: inline-block;
            background: var(--champagne);
            color: var(--wine-deep);
            font-weight: 500;
            padding: 1rem 2.3rem;
            border-radius: 999px;
            transition: background .2s;
        }
        .btn:hover { background: var(--champagne-soft); }

        .link-quiet {
            color: var(--champagne-soft);
            border-bottom: 1px solid rgba(216, 180, 142, .45);
            padding-bottom: 2px;
            transition: border-color .2s;
        }
        .link-quiet:hover { border-color: var(--champagne); }

        /* ---------- Photo arch ---------- */
        .arch-wrap {
            position: relative;
            justify-self: end;
            width: min(100%, 23rem);
            aspect-ratio: 3 / 4.3;
        }
        .arch-wrap::before {
            content: "";
            position: absolute;
            inset: 0;
            transform: translate(1.4rem, 1.4rem);
            border: 1px solid rgba(216, 180, 142, .55);
            border-radius: 999px 999px 0 0;
        }
        .arch {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            border-radius: 999px 999px 0 0;
            background:
                radial-gradient(90% 55% at 50% 12%, rgba(234, 211, 184, .5), transparent 65%),
                radial-gradient(70% 40% at 50% 100%, rgba(216, 180, 142, .18), transparent 70%),
                linear-gradient(170deg, var(--wine-soft) 0%, var(--wine) 55%, var(--wine-deep) 100%);
            animation: rise 1.4s cubic-bezier(.2, .7, .2, 1) both;
        }
        /* thin inner arch, like a passe-partout */
        .arch::before {
            content: "";
            position: absolute;
            inset: 1.1rem;
            border: 1px solid rgba(244, 234, 223, .22);
            border-radius: 999px 999px 0 0;
            z-index: 2;
            pointer-events: none;
        }
        .arch img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .arch-mark {
            position: absolute;
            left: 50%;
            bottom: 18%;
            width: 4.2rem;
            height: 4.2rem;
            transform: translateX(-50%);
            color: rgba(244, 234, 223, .55);
        }
        .arch::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(105deg, transparent 35%, rgba(244, 234, 223, .16) 50%, transparent 65%);
            transform: translateX(-100%);
            animation: sweep 2.2s .9s ease-out forwards;
            pointer-events: none;
        }
        @keyframes rise {
            from { clip-path: inset(100% 0 0 0); }
            to   { clip-path: inset(0 0 0 0); }
        }
        @keyframes sweep { to { transform: translateX(100%); } }

        /* today's hours, floating over the photo */
        .today {
            position: absolute;
            z-index: 3;
            left: -2.4rem;
            bottom: 3rem;
            padding: 1rem 1.4rem;
            background: rgba(34, 9, 15, .86);
            border: 1px solid rgba(216, 180, 142, .5);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
        }
        .today-label { margin: 0; font-size: .85rem; color: var(--mauve); }
        .today-hours {
            margin: 0;
            font-family: var(--display);
            font-size: 1.35rem;
            font-weight: 500;
            line-height: 1.2;
            color: var(--champagne-soft);
        }

        /* ---------- Section frame ---------- */
        .section {
            padding-block: clamp(3rem, 7vh, 5rem);
            border-top: 1px solid var(--line);
        }
        .section-title {
            font-family: var(--display);
            font-weight: 500;
            font-size: clamp(1.8rem, 2.8vw, 2.4rem);
            line-height: 1.08;
            letter-spacing: -.01em;
            margin: 0 0 3rem;
            color: var(--ivory);
        }

        /* ---------- Packages ---------- */
        .package-list { list-style: none; margin: 0; padding: 0; }
        .package-row {
            display: grid;
            grid-template-columns: 1fr auto auto;
            align-items: baseline;
            gap: 2rem;
            padding-block: 1.9rem;
            border-bottom: 1px solid var(--line);
        }
        .package-name {
            font-family: var(--display);
            font-weight: 500;
            font-size: clamp(1.35rem, 2vw, 1.7rem);
            line-height: 1.15;
            margin: 0;
            color: var(--ivory);
        }
        .package-note { margin: .3rem 0 0; font-size: .95rem; color: var(--mauve); }
        .package-duration { color: var(--mauve); white-space: nowrap; }
        .package-price {
            font-family: var(--display);
            font-weight: 500;
            font-size: 1.4rem;
            color: var(--champagne);
            white-space: nowrap;
        }
        .empty { color: var(--mauve); }

        /* ---------- How to book (a real sequence, so numbered) ---------- */
        .steps {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: clamp(1.5rem, 4vw, 4rem);
        }
        .step-num {
            display: block;
            font-family: var(--display);
            font-style: italic;
            font-weight: 400;
            font-size: 3rem;
            line-height: 1;
            color: var(--champagne);
            margin-bottom: 1rem;
        }
        .step-title {
            font-family: var(--display);
            font-weight: 500;
            font-size: 1.4rem;
            line-height: 1.2;
            margin: 0 0 .5rem;
            color: var(--ivory);
        }
        .step-text { margin: 0; max-width: 18rem; color: var(--mauve); }

        /* ---------- Closing call to action ---------- */
        .closing { text-align: center; }
        .closing .section-title {
            font-size: clamp(2rem, 3.6vw, 3rem);
            margin-bottom: 2.2rem;
        }
        .closing .section-title em { font-weight: 400; color: var(--champagne); }

        /* ---------- Footer ---------- */
        .footer {
            position: relative;
            z-index: 1;
            padding-block: 2.5rem 3rem;
            border-top: 1px solid var(--line);
            color: var(--mauve);
            font-size: .95rem;
        }
        .footer-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            justify-content: space-between;
            gap: .75rem 2rem;
        }
        .footer .brand { font-size: 1.3rem; }

        /* ---------- Responsive ---------- */
        @media (max-width: 860px) {
            .hero { grid-template-columns: 1fr; min-height: 0; }
            .arch-wrap { justify-self: center; width: min(76%, 22rem); margin-right: 1.4rem; }
            .today { left: -1rem; bottom: 2rem; }
            .package-row { grid-template-columns: 1fr auto; row-gap: .25rem; }
            .package-duration { grid-column: 1; grid-row: 2; }
            .package-price { grid-column: 2; grid-row: 1 / span 2; align-self: center; }
            .steps { grid-template-columns: 1fr; gap: 2.5rem; }
        }
        @media (max-width: 520px) {
            .nav-links { gap: 1rem; }
            .today { padding: .8rem 1rem; }
            .today-hours { font-size: 1.2rem; }
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            .arch { animation: none; }
            .arch::after { display: none; }
        }
    </style>
</head>
<body>
@php
    // Pakai data dari controller kalau ada, kalau tidak ambil langsung dari database
    $packages = $packages ?? \App\Models\Package::orderBy('price')->get();
    $heroPhoto = file_exists(public_path('images/hero.jpg')) ? asset('images/hero.jpg') : null;
    // Jam operasional hari ini (sama dengan aturan booking)
    $todayHours = now()->isSunday() ? '10.00–17.00' : '09.00–20.00';
@endphp

<div class="wrap">
    <header class="nav">
        <a href="{{ url('/') }}" class="brand">Framehaus</a>
        <nav class="nav-links" aria-label="Menu utama">
            <a href="#paket">Paket</a>
            <a href="#cara-pesan">Cara memesan</a>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('booking.create') }}" class="nav-cta">Pesan sekarang</a>
            @else
                @if (Route::has('login'))
                    <a href="{{ route('login') }}">Masuk</a>
                @endif
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-cta">Daftar</a>
                @endif
            @endauth
        </nav>
    </header>

    <main>
        <section class="hero">
            <div>
                <h1 class="hero-title">
                    Abadikan hari
                    <span class="second">yang ingin kamu ingat.</span>
                </h1>
                <p class="hero-lead">
                    Studio foto dengan pencahayaan profesional. Pesan online dan datang sesuai jadwalmu.
                </p>
                <div class="actions">
                    <a href="{{ route('booking.create') }}" class="btn">Pesan sekarang</a>
                    <a href="#paket" class="link-quiet">Lihat paket</a>
                </div>
            </div>

            <div class="arch-wrap">
                <div class="arch" role="img" aria-label="Foto studio Framehaus">
                    @if ($heroPhoto)
                        <img src="{{ $heroPhoto }}" alt="">
                    @else
                        <svg class="arch-mark" viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                            <circle cx="32" cy="32" r="30"/>
                            <path d="M32 2 L46 26 M58 20 L34 22 M60 44 L44 30 M32 62 L18 38 M6 44 L30 42 M4 20 L20 34"/>
                        </svg>
                    @endif
                </div>
                <div class="today">
                    <p class="today-label">Jam buka hari ini</p>
                    <p class="today-hours">{{ $todayHours }}</p>
                </div>
            </div>
        </section>

        <section class="section" id="paket">
            <h2 class="section-title">Paket sesi foto</h2>

            @if ($packages->isEmpty())
                <p class="empty">Paket belum tersedia. Silakan cek lagi nanti.</p>
            @else
                <ul class="package-list">
                    @foreach ($packages as $package)
                        <li class="package-row">
                            <div>
                                <h3 class="package-name">{{ $package->name }}</h3>
                                @if (!empty($package->description))
                                    <p class="package-note">{{ \Illuminate\Support\Str::limit($package->description, 80) }}</p>
                                @endif
                            </div>
                            <span class="package-duration">{{ $package->duration_minutes }} menit</span>
                            <span class="package-price">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        <section class="section" id="cara-pesan">
            <h2 class="section-title">Cara memesan</h2>
            <ol class="steps">
                <li>
                    <span class="step-num">1</span>
                    <h3 class="step-title">Pilih paket</h3>
                    <p class="step-text">Sesuaikan dengan kebutuhan dan durasi sesimu.</p>
                </li>
                <li>
                    <span class="step-num">2</span>
                    <h3 class="step-title">Pilih jadwal</h3>
                    <p class="step-text">Lihat jam yang tersedia, lalu konfirmasi.</p>
                </li>
                <li>
                    <span class="step-num">3</span>
                    <h3 class="step-title">Datang ke studio</h3>
                    <p class="step-text">Tunjukkan kode booking saat tiba.</p>
                </li>
            </ol>
        </section>

        <section class="section closing">
            <h2 class="section-title">Pesan sesimu <em>hari ini.</em></h2>
            <a href="{{ route('booking.create') }}" class="btn">Mulai pesan</a>
        </section>
    </main>
</div>

<footer class="footer">
    <div class="wrap footer-inner">
        <a href="{{ url('/') }}" class="brand">Framehaus</a>
        <span>Senin–Sabtu 09.00–20.00</span>
        <span>Minggu 10.00–17.00</span>
    </div>
</footer>
</body>
</html>