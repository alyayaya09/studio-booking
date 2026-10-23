<x-app-layout>
    <style>
        .lux { padding: 3rem 0 5rem; }

        .lux-hero { text-align: center; margin-bottom: 3rem; }
        .lux-eyebrow {
            font-size: .75rem;
            letter-spacing: .35em;
            text-transform: uppercase;
            color: var(--champagne);
        }
        .lux-title {
            font-family: var(--display);
            font-size: clamp(2.5rem, 7vw, 4rem);
            font-weight: 500;
            line-height: 1.05;
            color: var(--ivory);
            margin-top: .75rem;
        }
        .lux-title em { font-style: italic; color: var(--champagne); }
        .lux-sub { color: var(--mauve); margin-top: 1rem; font-size: .95rem; }
        .lux-divider {
            width: 90px;
            height: 1px;
            margin: 1.75rem auto 0;
            background: linear-gradient(90deg, transparent, var(--champagne), transparent);
        }

        .lux-step { margin-bottom: 3rem; }
        .lux-step-head { display: flex; align-items: baseline; gap: 1rem; margin-bottom: 1.5rem; }
        .lux-num {
            font-family: var(--display);
            font-size: 2.25rem;
            font-style: italic;
            color: var(--champagne);
            line-height: 1;
        }
        .lux-step-title {
            font-family: var(--display);
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--champagne-soft);
        }
        .lux-step-line { flex: 1; height: 1px; background: var(--line); }

        /* Kartu paket */
        .lux-pkgs { display: grid; gap: 1rem; grid-template-columns: 1fr; }
        @media (min-width: 640px) { .lux-pkgs { grid-template-columns: 1fr 1fr; } }

        .lux-pkg { position: relative; display: block; cursor: pointer; }
        .lux-pkg input {
            position: absolute;
            opacity: 0;
            inset: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }
        .lux-pkg-body {
            height: 100%;
            padding: 1.5rem;
            border-radius: .9rem;
            border: 1px solid var(--line);
            background: linear-gradient(160deg, var(--wine-soft), var(--wine));
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
        }
        .lux-pkg:hover .lux-pkg-body { transform: translateY(-3px); border-color: var(--champagne); }
        .lux-pkg input:focus-visible + .lux-pkg-body { border-color: var(--champagne); }
        .lux-pkg input:checked + .lux-pkg-body {
            border-color: var(--champagne);
            background: linear-gradient(160deg, #5a2434, var(--wine-soft));
            box-shadow: 0 0 0 1px var(--champagne), 0 12px 32px rgba(0, 0, 0, .35);
        }
        .lux-pkg-check {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 1.5rem;
            height: 1.5rem;
            border-radius: 999px;
            border: 1px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            color: transparent;
        }
        .lux-pkg input:checked + .lux-pkg-body .lux-pkg-check {
            background: var(--champagne);
            border-color: var(--champagne);
            color: var(--wine-deep);
        }
        .lux-pkg-name {
            font-family: var(--display);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--ivory);
            padding-right: 2rem;
        }
        .lux-pkg-desc { color: var(--mauve); font-size: .85rem; margin-top: .4rem; }
        .lux-pkg-foot {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid var(--line);
        }
        .lux-pkg-dur { color: var(--mauve); font-size: .8rem; letter-spacing: .08em; text-transform: uppercase; }
        .lux-pkg-price { font-family: var(--display); font-size: 1.5rem; font-weight: 600; color: var(--champagne); }

        /* Isian */
        .lux-grid { display: grid; gap: 1.5rem; grid-template-columns: 1fr; }
        @media (min-width: 640px) { .lux-grid { grid-template-columns: 1fr 1fr; } }

        .lux-label {
            display: block;
            font-size: .7rem;
            letter-spacing: .25em;
            text-transform: uppercase;
            color: var(--champagne);
            margin-bottom: .5rem;
        }
        .lux-input {
            display: block;
            width: 100%;
            padding: .9rem 1rem;
            border-radius: .6rem;
            border: 1px solid var(--line);
            background: var(--wine);
            color: var(--ivory);
            color-scheme: dark;
            font-size: 1rem;
        }
        .lux-input:focus {
            outline: none;
            border-color: var(--champagne);
            box-shadow: 0 0 0 1px var(--champagne);
        }
        .lux-input::placeholder { color: var(--mauve); opacity: .6; }
        .lux .text-red-600 { color: #f4a6a6; }

        .lux-info {
            display: flex;
            gap: .75rem;
            align-items: flex-start;
            margin-top: 1.5rem;
            padding: 1rem 1.25rem;
            border: 1px solid var(--line);
            border-radius: .6rem;
            background: rgba(216, 180, 142, .06);
            color: var(--mauve);
            font-size: .85rem;
            line-height: 1.6;
        }
        .lux-info strong { color: var(--champagne-soft); font-weight: 500; }

        .lux-submit {
            width: 100%;
            margin-top: 2rem;
            padding: 1.1rem 1.5rem;
            border: 0;
            border-radius: .6rem;
            cursor: pointer;
            font-family: var(--body);
            font-weight: 600;
            font-size: .85rem;
            letter-spacing: .3em;
            text-transform: uppercase;
            color: var(--wine-deep);
            background: linear-gradient(135deg, var(--champagne-soft), var(--champagne));
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .lux-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(216, 180, 142, .25); }

        .lux-alert {
            margin-bottom: 2rem;
            padding: 1rem 1.25rem;
            border-radius: .6rem;
            border: 1px solid var(--champagne);
            background: rgba(216, 180, 142, .12);
            color: var(--champagne-soft);
            text-align: center;
        }

        /* HP: margin kiri-kanan diperlebar, kotak jadi lebih sempit dan ramping */
        @media (max-width: 640px) {
            .lux { padding: 1.25rem 0 2.5rem; }
            .lux > div { padding-left: 1.75rem; padding-right: 1.75rem; }

            .lux-hero { margin-bottom: 1.5rem; }
            .lux-sub { margin-top: .6rem; }
            .lux-divider { margin-top: 1rem; }

            .lux-alert { margin-bottom: 1rem; padding: .7rem .9rem; }

            .lux-step { margin-bottom: 1.5rem; }
            .lux-step-head { gap: .75rem; margin-bottom: .9rem; }

            .lux-pkgs { gap: .6rem; }
            .lux-pkg-body { padding: .8rem .9rem; border-radius: .7rem; }
            .lux-pkg-check { top: .7rem; right: .7rem; }
            .lux-pkg-desc { margin-top: .25rem; }
            .lux-pkg-foot { margin-top: .6rem; padding-top: .5rem; }

            .lux-grid { gap: .9rem; }
            .lux-label { margin-bottom: .35rem; }
            .lux-input { padding: .55rem .75rem; border-radius: .5rem; }
            textarea.lux-input { height: 5rem; }

            .lux-info { margin-top: .9rem; padding: .65rem .85rem; }

            .lux-submit { margin-top: 1.25rem; padding: .75rem 1rem; }
        }
    </style>

    <div class="lux">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="lux-hero">
                <div class="lux-eyebrow">Framehaus Studio</div>
                <h1 class="lux-title">Abadikan momen <em>istimewamu</em></h1>
                <p class="lux-sub">Pilih paket, tentukan jadwal, dan biarkan tim kami yang mengurus sisanya.</p>
                <div class="lux-divider"></div>
            </div>

            @if (session('status'))
                <div class="lux-alert">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('booking.store') }}">
                @csrf

                {{-- 01 Pilih paket --}}
                <section class="lux-step">
                    <div class="lux-step-head">
                        <span class="lux-num">01</span>
                        <span class="lux-step-title">Pilih Paket</span>
                        <span class="lux-step-line"></span>
                    </div>

                    <div class="lux-pkgs">
                        @foreach ($packages as $package)
                            <label class="lux-pkg">
                                <input type="radio" name="package_id" value="{{ $package->id }}"
                                    @checked(old('package_id') == $package->id) required>
                                <div class="lux-pkg-body">
                                    <span class="lux-pkg-check">&#10003;</span>
                                    <div class="lux-pkg-name">{{ $package->name }}</div>
                                    @if ($package->description)
                                        <div class="lux-pkg-desc">{{ $package->description }}</div>
                                    @endif
                                    <div class="lux-pkg-foot">
                                        <span class="lux-pkg-dur">{{ $package->duration_minutes }} menit</span>
                                        <span class="lux-pkg-price">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('package_id')" class="mt-3" />
                </section>

                {{-- 02 Jadwal --}}
                <section class="lux-step">
                    <div class="lux-step-head">
                        <span class="lux-num">02</span>
                        <span class="lux-step-title">Tentukan Jadwal</span>
                        <span class="lux-step-line"></span>
                    </div>

                    <div class="lux-grid">
                        <div>
                            <label class="lux-label" for="booking_date">Tanggal</label>
                            <input class="lux-input" id="booking_date" name="booking_date" type="date"
                                value="{{ old('booking_date') }}" min="{{ now()->toDateString() }}" required>
                            <x-input-error :messages="$errors->get('booking_date')" class="mt-2" />
                        </div>

                        <div>
                            <label class="lux-label" for="start_time">Jam Mulai</label>
                            <input class="lux-input" id="start_time" name="start_time" type="time"
                                value="{{ old('start_time') }}" required>
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>
                    </div>

                    <div class="lux-info">
                        <span class="gold">&#9679;</span>
                        <span>
                            <strong>Jam operasional:</strong> Senin&ndash;Sabtu 09.00&ndash;20.00, Minggu 10.00&ndash;17.00.
                            Fotografer ditentukan oleh studio.
                        </span>
                    </div>
                </section>

                {{-- 03 Catatan --}}
                <section class="lux-step">
                    <div class="lux-step-head">
                        <span class="lux-num">03</span>
                        <span class="lux-step-title">Catatan</span>
                        <span class="lux-step-line"></span>
                    </div>

                    <label class="lux-label" for="notes">Permintaan khusus (opsional)</label>
                    <textarea class="lux-input" id="notes" name="notes" rows="4"
                        placeholder="Contoh: konsep, jumlah orang, atau kebutuhan lainnya">{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />

                    <button type="submit" class="lux-submit">Pesan Sekarang</button>
                </section>
            </form>
        </div>
    </div>
</x-app-layout>