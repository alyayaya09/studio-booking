<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Framehaus Studio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --bg:#0f0f10; --card:#19191b; --gold:#c9a24b; --text:#f2f0ea; --muted:#9a9890; }
        * { box-sizing:border-box; margin:0; padding:0; }
        body { background:var(--bg); color:var(--text); font-family:'Inter',sans-serif; line-height:1.6; }
        a { text-decoration:none; color:inherit; }
        .container { max-width:1100px; margin:0 auto; padding:0 20px; }
        nav { display:flex; justify-content:space-between; align-items:center; padding:20px 0; }
        .logo { font-family:'Playfair Display',serif; font-size:1.6rem; color:var(--gold); }
        .nav-links { display:flex; gap:12px; }
        .btn { display:inline-block; padding:10px 22px; border-radius:6px; font-weight:600; border:1px solid var(--gold); }
        .btn-gold { background:var(--gold); color:#111; }
        .hero { text-align:center; padding:90px 0 70px; }
        .hero h1 { font-family:'Playfair Display',serif; font-size:clamp(2.2rem,6vw,3.8rem); line-height:1.2; margin-bottom:18px; }
        .hero h1 span { color:var(--gold); }
        .hero p { color:var(--muted); max-width:560px; margin:0 auto 30px; }
        h2 { font-family:'Playfair Display',serif; text-align:center; font-size:2rem; margin-bottom:8px; }
        .sub { text-align:center; color:var(--muted); margin-bottom:40px; }
        .grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(260px,1fr)); gap:20px; }
        .card { background:var(--card); border:1px solid #2a2a2d; border-radius:10px; padding:26px; }
        .card h3 { margin-bottom:6px; }
        .card .dur { color:var(--muted); font-size:.9rem; margin-bottom:14px; }
        .card .price { color:var(--gold); font-size:1.4rem; font-weight:600; margin-bottom:18px; }
        section { padding:50px 0; }
        .info { text-align:center; color:var(--muted); }
        .info strong { color:var(--text); }
        footer { text-align:center; color:var(--muted); font-size:.85rem; padding:30px 0; border-top:1px solid #2a2a2d; margin-top:40px; }
    </style>
</head>
<body>
    <div class="container">
        <nav>
            <a href="{{ route('home') }}" class="logo">Framehaus</a>
            <div class="nav-links">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-gold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn">Masuk</a>
                    <a href="{{ route('register') }}" class="btn btn-gold">Daftar</a>
                @endauth
            </div>
        </nav>

        <div class="hero">
            <h1>Abadikan momen Anda di <span>Framehaus</span></h1>
            <p>Pesan sesi foto lengkap dengan fotografer profesional. Pilih paket, tentukan jadwal, kami yang mengatur sisanya.</p>
            <a href="{{ route('booking.create') }}" class="btn btn-gold">Pesan Sesi Sekarang</a>
        </div>

        <section>
            <h2>Paket Foto</h2>
            <p class="sub">Semua paket sudah termasuk fotografer.</p>
            <div class="grid">
                @forelse ($packages as $package)
                    <div class="card">
                        <h3>{{ $package->name }}</h3>
                        <div class="dur">{{ $package->duration }} menit</div>
                        <div class="price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                        <a href="{{ route('booking.create') }}" class="btn">Pilih Paket</a>
                    </div>
                @empty
                    <p class="info">Belum ada paket tersedia.</p>
                @endforelse
            </div>
        </section>

        <section class="info">
            <h2>Jam Operasional</h2>
            <p class="sub">Kami siap melayani Anda</p>
            <p><strong>Senin - Sabtu:</strong> 09.00 - 20.00</p>
            <p><strong>Minggu:</strong> 10.00 - 17.00</p>
        </section>

        <footer>&copy; {{ date('Y') }} Framehaus Studio. Semua hak dilindungi.</footer>
    </div>
</body>
</html>