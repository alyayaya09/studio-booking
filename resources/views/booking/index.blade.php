<x-app-layout>
    <x-slot name="header">
        <h2>Booking Saya</h2>
    </x-slot>

    <style>
        .bk { padding: 3rem 0 5rem; }

        .bk-list { display: grid; gap: 1rem; }

        .bk-card {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            justify-content: space-between;
            gap: 1.25rem;
            padding: 1.5rem;
            border-radius: .9rem;
            border: 1px solid var(--line);
            background: linear-gradient(160deg, var(--wine-soft), var(--wine));
            transition: border-color .2s ease, transform .2s ease;
        }
        .bk-card:hover { border-color: var(--champagne); transform: translateY(-2px); }

        .bk-main { flex: 1 1 260px; min-width: 0; }

        .bk-name {
            font-family: var(--display);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--ivory);
            line-height: 1.2;
        }
        .bk-date {
            margin-top: .5rem;
            color: var(--champagne-soft);
            font-size: .95rem;
        }
        .bk-meta {
            margin-top: .35rem;
            color: var(--mauve);
            font-size: .85rem;
        }
        .bk-meta strong { color: var(--champagne-soft); font-weight: 500; }

        .bk-side {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: .75rem;
        }

        .bk-price {
            font-family: var(--display);
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--champagne);
        }

        .bk-status {
            display: inline-block;
            padding: .3rem .85rem;
            border-radius: 999px;
            border: 1px solid var(--line);
            font-size: .7rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--champagne-soft);
            background: rgba(216, 180, 142, .08);
        }
        .bk-status.is-pending   { color: #f0d9a8; border-color: rgba(240, 217, 168, .45); background: rgba(240, 217, 168, .10); }
        .bk-status.is-confirmed { color: #a9dcb8; border-color: rgba(169, 220, 184, .45); background: rgba(169, 220, 184, .10); }
        .bk-status.is-done      { color: var(--champagne-soft); border-color: var(--champagne); background: rgba(216, 180, 142, .15); }
        .bk-status.is-cancelled { color: #f4a6a6; border-color: rgba(244, 166, 166, .45); background: rgba(244, 166, 166, .10); }

        .bk-empty {
            padding: 3rem 1.5rem;
            text-align: center;
            border-radius: .9rem;
            border: 1px dashed var(--line);
            background: var(--wine);
            color: var(--mauve);
        }
        .bk-empty-title {
            font-family: var(--display);
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--champagne-soft);
            margin-bottom: .5rem;
        }
        .bk-cta {
            display: inline-block;
            margin-top: 1.5rem;
            padding: .9rem 1.75rem;
            border-radius: .6rem;
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .25em;
            text-transform: uppercase;
            text-decoration: none;
            color: var(--wine-deep);
            background: linear-gradient(135deg, var(--champagne-soft), var(--champagne));
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .bk-cta:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(216, 180, 142, .25); }

        /* HP: margin kiri-kanan diperlebar, kartu jadi lebih sempit dan ramping */
        @media (max-width: 640px) {
            .bk { padding: 1.25rem 0 2.5rem; }
            .bk > div { padding-left: 1.75rem; padding-right: 1.75rem; }

            .bk-list { gap: .65rem; }

            .bk-card { padding: .85rem 1rem; gap: .7rem; border-radius: .7rem; }
            .bk-card:hover { transform: none; }

            .bk-date { margin-top: .3rem; }
            .bk-meta { margin-top: .2rem; }

            .bk-side {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                gap: .5rem;
                padding-top: .6rem;
                border-top: 1px solid var(--line);
            }
            .bk-status { padding: .2rem .65rem; }

            .bk-empty { padding: 1.75rem 1rem; border-radius: .7rem; }
            .bk-empty-title { margin-bottom: .3rem; }
            .bk-cta { margin-top: 1rem; padding: .7rem 1.25rem; }
        }
    </style>

    <div class="bk">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bk-list">
                @forelse ($bookings as $booking)
                    @php
                        $statusClass = match (strtolower($booking->status)) {
                            'pending' => 'is-pending',
                            'confirmed', 'approved' => 'is-confirmed',
                            'completed', 'done' => 'is-done',
                            'cancelled', 'canceled', 'rejected' => 'is-cancelled',
                            default => '',
                        };
                    @endphp

                    <div class="bk-card">
                        <div class="bk-main">
                            <h3 class="bk-name">{{ $booking->package->name }}</h3>
                            <p class="bk-date">
                                {{ $booking->booking_date->translatedFormat('l, d F Y') }},
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H.i') }}
                                &ndash; {{ \Carbon\Carbon::parse($booking->end_time)->format('H.i') }}
                            </p>
                            <p class="bk-meta">
                                Fotografer: <strong>{{ $booking->photographer?->name ?? 'Menunggu penugasan' }}</strong>
                            </p>
                            @if ($booking->notes)
                                <p class="bk-meta">Catatan: {{ $booking->notes }}</p>
                            @endif
                        </div>

                        <div class="bk-side">
                            <span class="bk-status {{ $statusClass }}">{{ $booking->status }}</span>
                            <span class="bk-price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="bk-empty">
                        <div class="bk-empty-title">Belum ada booking</div>
                        <p>Jadwalkan sesi foto pertamamu bersama Framehaus Studio.</p>
                        <a href="{{ route('booking.create') }}" class="bk-cta">Pesan Sesi Sekarang</a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>