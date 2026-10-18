<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard · Framehaus</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Hanken+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">

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

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ivory);
            font-family: var(--body);
            font-weight: 300;
            line-height: 1.65;
            -webkit-font-smoothing: antialiased;
            background:
                radial-gradient(60rem 40rem at 85% -5%, rgba(74, 29, 41, .85), transparent 60%),
                radial-gradient(50rem 36rem at -10% 70%, rgba(52, 18, 27, .9), transparent 65%),
                var(--wine-deep);
            background-attachment: fixed;
        }

        a { color: inherit; text-decoration: none; }
        a:focus-visible, button:focus-visible {
            outline: 2px solid var(--champagne);
            outline-offset: 4px;
        }

        .wrap { width: min(1100px, 100% - 3rem); margin-inline: auto; }

        /* ---------- Nav ---------- */
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            padding-block: 1.5rem;
            border-bottom: 1px solid var(--line);
        }
        .brand {
            font-family: var(--display);
            font-weight: 500;
            font-size: 1.5rem;
            color: var(--champagne-soft);
            white-space: nowrap;
        }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.6rem;
            font-size: .95rem;
            overflow-x: auto;
        }
        .nav-links a, .nav-links button {
            color: var(--mauve);
            white-space: nowrap;
            transition: color .2s;
        }
        .nav-links a:hover, .nav-links button:hover { color: var(--ivory); }
        .nav-links .active { color: var(--champagne-soft); }
        .logout {
            font: inherit;
            background: none;
            border: 1px solid rgba(216, 180, 142, .5);
            color: var(--champagne-soft);
            padding: .45rem 1.2rem;
            border-radius: 999px;
            cursor: pointer;
        }
        .nav-links .logout:hover { background: var(--champagne); color: var(--wine-deep); }

        /* ---------- Page head ---------- */
        .head { padding-block: clamp(2rem, 5vh, 3.5rem) 2rem; }
        .greeting {
            font-family: var(--display);
            font-weight: 500;
            font-size: clamp(1.9rem, 3.4vw, 2.6rem);
            line-height: 1.1;
            margin: 0 0 .4rem;
        }
        .greeting em { font-weight: 400; color: var(--champagne); }
        .sub { margin: 0; color: var(--mauve); }

        /* ---------- Shared bits ---------- */
        .label { margin: 0; font-size: .9rem; color: var(--mauve); }
        .block { padding-block: 2rem; border-top: 1px solid var(--line); }
        .block-title {
            font-family: var(--display);
            font-weight: 500;
            font-size: 1.6rem;
            line-height: 1.2;
            margin: 0;
        }
        .block-head {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }
        .link-quiet {
            color: var(--champagne-soft);
            font-size: .95rem;
            border-bottom: 1px solid rgba(216, 180, 142, .45);
            padding-bottom: 2px;
        }
        .link-quiet:hover { border-color: var(--champagne); }

        .btn {
            display: inline-block;
            background: var(--champagne);
            color: var(--wine-deep);
            font-weight: 500;
            padding: .85rem 1.9rem;
            border-radius: 999px;
            transition: background .2s;
        }
        .btn:hover { background: var(--champagne-soft); }

        /* ---------- Status pills ---------- */
        .pill {
            display: inline-block;
            padding: .15rem .8rem;
            border-radius: 999px;
            font-size: .85rem;
            border: 1px solid rgba(179, 148, 153, .5);
            color: var(--mauve);
            white-space: nowrap;
        }
        .pill-pending   { border-color: var(--champagne); color: var(--champagne); }
        .pill-confirmed { background: var(--champagne); border-color: var(--champagne); color: var(--wine-deep); font-weight: 500; }
        .pill-completed { background: rgba(179, 148, 153, .18); }

        /* ---------- Admin: revenue ---------- */
        .revenue {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-end;
            justify-content: space-between;
            gap: 1.5rem;
            padding-block: 2rem;
            border-top: 1px solid var(--line);
        }
        .revenue-value {
            font-family: var(--display);
            font-weight: 500;
            font-size: clamp(2.2rem, 4.4vw, 3.2rem);
            line-height: 1.05;
            color: var(--champagne-soft);
            margin: .15rem 0 0;
        }
        .quick { display: flex; flex-wrap: wrap; gap: .75rem; }
        .quick a {
            border: 1px solid rgba(216, 180, 142, .45);
            color: var(--champagne-soft);
            padding: .55rem 1.2rem;
            border-radius: 999px;
            font-size: .95rem;
            transition: background .2s, color .2s;
        }
        .quick a:hover { background: var(--champagne); color: var(--wine-deep); }

        /* ---------- Admin: stat grid ---------- */
        .stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1.5rem;
            padding-block: 2rem;
            border-top: 1px solid var(--line);
        }
        .stat { border-left: 1px solid var(--line); padding-left: 1.1rem; }
        .stat-value {
            font-family: var(--display);
            font-weight: 500;
            font-size: 2.1rem;
            line-height: 1.1;
            margin: .1rem 0 0;
            color: var(--ivory);
        }

        /* ---------- Admin: status bar ---------- */
        .bar {
            display: flex;
            height: .6rem;
            border-radius: 999px;
            overflow: hidden;
            background: rgba(244, 234, 223, .08);
        }
        .bar-pending   { background: var(--champagne); opacity: .55; }
        .bar-confirmed { background: var(--champagne-soft); }
        .bar-other     { background: var(--mauve); opacity: .6; }
        .legend { display: flex; flex-wrap: wrap; gap: .5rem 1.75rem; margin-top: .9rem; font-size: .9rem; color: var(--mauve); }
        .dot { display: inline-block; width: .6rem; height: .6rem; border-radius: 50%; margin-right: .45rem; }

        /* ---------- Booking list ---------- */
        .rows { list-style: none; margin: 0; padding: 0; }
        .row {
            display: grid;
            grid-template-columns: 1fr auto auto;
            align-items: center;
            gap: 1.5rem;
            padding-block: 1rem;
            border-top: 1px solid var(--line);
        }
        .row-name { margin: 0; color: var(--ivory); font-weight: 400; }
        .row-sub { margin: 0; font-size: .92rem; color: var(--mauve); }
        .row-date { color: var(--mauve); white-space: nowrap; }
        .empty { margin: 0; color: var(--mauve); }

        /* ---------- User: next session ---------- */
        .session {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 2rem;
            align-items: end;
        }
        .session-package {
            font-family: var(--display);
            font-weight: 500;
            font-size: clamp(1.7rem, 3vw, 2.3rem);
            line-height: 1.15;
            margin: .15rem 0 .6rem;
        }
        .session-when { margin: 0; font-size: 1.05rem; color: var(--champagne-soft); }
        .session-meta { margin: 0 0 .6rem; color: var(--mauve); }
        .session-meta strong { font-weight: 400; color: var(--ivory); }

        .total-line { display: flex; align-items: baseline; gap: .75rem; margin-top: 1.25rem; }
        .total-number {
            font-family: var(--display);
            font-weight: 500;
            font-size: 2.1rem;
            line-height: 1;
            color: var(--champagne);
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 860px) {
            .stats { grid-template-columns: repeat(2, 1fr); }
            .session { grid-template-columns: 1fr; }
        }
        @media (max-width: 560px) {
            .nav { flex-direction: column; align-items: flex-start; gap: .9rem; }
            .nav-links { width: 100%; }
            .row { grid-template-columns: 1fr auto; row-gap: .35rem; }
            .row-date { grid-column: 1; grid-row: 2; }
            .row .pill { grid-column: 2; grid-row: 1 / span 2; }
        }
    </style>
</head>
<body>
@php
    $user = Auth::user();
    $firstName = \Illuminate\Support\Str::before($user->name, ' ');
@endphp

<div class="wrap">
    <header class="nav">
        <a href="{{ url('/') }}" class="brand">Framehaus</a>

        <nav class="nav-links" aria-label="Menu dashboard">
            <a href="{{ route('dashboard') }}" class="active">Dashboard</a>

            @if ($user->is_admin)
                @if (Route::has('admin.packages.index'))
                    <a href="{{ route('admin.packages.index') }}">Paket</a>
                @endif
                @if (Route::has('admin.photographers.index'))
                    <a href="{{ route('admin.photographers.index') }}">Fotografer</a>
                @endif
                @if (Route::has('admin.bookings.index'))
                    <a href="{{ route('admin.bookings.index') }}">Booking</a>
                @endif
            @else
                @if (Route::has('booking.index'))
                    <a href="{{ route('booking.index') }}">Booking saya</a>
                @endif
                <a href="{{ route('booking.create') }}">Pesan sesi</a>
            @endif

            @if (Route::has('profile.edit'))
                <a href="{{ route('profile.edit') }}">Profil</a>
            @endif

            {{-- Logout wajib POST + CSRF --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout">Keluar</button>
            </form>
        </nav>
    </header>

    <main>
        <section class="head">
            <h1 class="greeting">Halo, <em>{{ $firstName }}</em></h1>
            <p class="sub">
                {{ $user->is_admin ? 'Ringkasan booking dan pengelolaan studio.' : 'Lihat jadwal sesi fotomu di sini.' }}
            </p>
        </section>

        @if ($user->is_admin)
            @php
                // Komposisi status booking untuk bar (persen dari total)
                $total = max($stats['total'], 0);
                $pendingPct = $total ? round($stats['pending'] / $total * 100, 1) : 0;
                $confirmedPct = $total ? round($stats['confirmed'] / $total * 100, 1) : 0;
                $otherCount = max($total - $stats['pending'] - $stats['confirmed'], 0);
                $otherPct = $total ? max(100 - $pendingPct - $confirmedPct, 0) : 0;
            @endphp

            <section class="revenue">
                <div>
                    <p class="label">Pendapatan</p>
                    <p class="revenue-value">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
                </div>
                <div class="quick">
                    @if (Route::has('admin.bookings.index'))
                        <a href="{{ route('admin.bookings.index') }}">Kelola booking</a>
                    @endif
                    @if (Route::has('admin.packages.index'))
                        <a href="{{ route('admin.packages.index') }}">Kelola paket</a>
                    @endif
                    @if (Route::has('admin.photographers.index'))
                        <a href="{{ route('admin.photographers.index') }}">Kelola fotografer</a>
                    @endif
                </div>
            </section>

            <section class="stats" aria-label="Statistik">
                <div class="stat">
                    <p class="label">Total booking</p>
                    <p class="stat-value">{{ $stats['total'] }}</p>
                </div>
                <div class="stat">
                    <p class="label">Menunggu konfirmasi</p>
                    <p class="stat-value">{{ $stats['pending'] }}</p>
                </div>
                <div class="stat">
                    <p class="label">Sudah dikonfirmasi</p>
                    <p class="stat-value">{{ $stats['confirmed'] }}</p>
                </div>
                <div class="stat">
                    <p class="label">Paket</p>
                    <p class="stat-value">{{ $stats['packages'] }}</p>
                </div>
                <div class="stat">
                    <p class="label">Fotografer</p>
                    <p class="stat-value">{{ $stats['photographers'] }}</p>
                </div>
            </section>

            <section class="block">
                <div class="block-head">
                    <h2 class="block-title">Komposisi status</h2>
                </div>
                <div class="bar" role="img" aria-label="Komposisi status booking">
                    <span class="bar-confirmed" style="width: {{ $confirmedPct }}%"></span>
                    <span class="bar-pending" style="width: {{ $pendingPct }}%"></span>
                    <span class="bar-other" style="width: {{ $otherPct }}%"></span>
                </div>
                <div class="legend">
                    <span><i class="dot" style="background: var(--champagne-soft)"></i>Dikonfirmasi {{ $stats['confirmed'] }}</span>
                    <span><i class="dot" style="background: var(--champagne); opacity: .55"></i>Menunggu {{ $stats['pending'] }}</span>
                    <span><i class="dot" style="background: var(--mauve); opacity: .6"></i>Lainnya {{ $otherCount }}</span>
                </div>
            </section>

            <section class="block">
                <div class="block-head">
                    <h2 class="block-title">Booking terbaru</h2>
                    @if (Route::has('admin.bookings.index'))
                        <a href="{{ route('admin.bookings.index') }}" class="link-quiet">Lihat semua</a>
                    @endif
                </div>

                @if ($latest->isEmpty())
                    <p class="empty">Belum ada booking.</p>
                @else
                    <ul class="rows">
                        @foreach ($latest as $booking)
                            <li class="row">
                                <div>
                                    <p class="row-name">{{ $booking->user->name }}</p>
                                    <p class="row-sub">{{ $booking->package->name }}</p>
                                </div>
                                <span class="row-date">{{ $booking->booking_date->format('d/m/Y') }}</span>
                                <span class="pill pill-{{ \Illuminate\Support\Str::slug($booking->status) }}">{{ ucfirst($booking->status) }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </section>
        @else
            <section class="block">
                <div class="block-head">
                    <h2 class="block-title">Sesi foto berikutnya</h2>
                </div>

                @if ($upcoming)
                    <div class="session">
                        <div>
                            <p class="label">Paket</p>
                            <p class="session-package">{{ $upcoming->package->name }}</p>
                            <p class="session-when">
                                {{ $upcoming->booking_date->translatedFormat('l, d F Y') }},
                                {{ \Carbon\Carbon::parse($upcoming->start_time)->format('H.i') }}
                                – {{ \Carbon\Carbon::parse($upcoming->end_time)->format('H.i') }}
                            </p>
                        </div>
                        <div>
                            <p class="session-meta">Fotografer: <strong>{{ $upcoming->photographer?->name ?? 'Ditentukan studio' }}</strong></p>
                            <span class="pill pill-{{ \Illuminate\Support\Str::slug($upcoming->status) }}">{{ ucfirst($upcoming->status) }}</span>
                        </div>
                    </div>
                @else
                    <p class="empty" style="margin-bottom: 1.25rem;">Belum ada sesi yang akan datang.</p>
                    <a href="{{ route('booking.create') }}" class="btn">Pesan sesi foto</a>
                @endif
            </section>

            <section class="block">
                <div class="block-head">
                    <h2 class="block-title">Riwayat kamu</h2>
                    @if (Route::has('booking.index'))
                        <a href="{{ route('booking.index') }}" class="link-quiet">Lihat semua booking</a>
                    @endif
                </div>
                <div class="total-line">
                    <span class="total-number">{{ $myTotal }}</span>
                    <span class="label">total booking</span>
                </div>
            </section>
        @endif
    </main>
</div>
</body>
</html>