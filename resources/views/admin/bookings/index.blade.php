<x-app-layout>
    <x-slot name="header">
        <h2>Kelola Booking</h2>
    </x-slot>

    <style>
        .ad { padding: 3.5rem 0 6rem; }

        .ad-container {
            max-width: 96rem;
            margin: 0 auto;
            padding: 0 1rem;
        }
        @media (min-width: 1024px) {
            .ad-container { padding: 0 2.5rem; }
        }

        .ad-alert {
            margin-bottom: 1.75rem;
            padding: 1.2rem 1.6rem;
            border-radius: .7rem;
            border: 1px solid var(--champagne);
            background: rgba(216, 180, 142, .12);
            color: var(--champagne-soft);
            font-size: 1.05rem;
        }

        .ad-wrap {
            overflow-x: auto;
            border-radius: 1.1rem;
            border: 1px solid var(--line);
            background: var(--wine);
            box-shadow: 0 14px 40px rgba(0, 0, 0, .3);
        }

        .ad-table { width: 100%; min-width: 1100px; border-collapse: collapse; font-size: 1.15rem; }

        .ad-table thead th {
            padding: 1.6rem 2rem;
            text-align: left;
            font-size: .9rem;
            font-weight: 500;
            letter-spacing: .25em;
            text-transform: uppercase;
            color: var(--champagne);
            background: var(--wine-soft);
            border-bottom: 1px solid var(--line);
            white-space: nowrap;
        }

        .ad-table tbody td {
            padding: 1.9rem 2rem;
            vertical-align: middle;
            color: var(--champagne-soft);
            border-bottom: 1px solid var(--line);
        }
        .ad-table tbody tr:last-child td { border-bottom: 0; }
        .ad-table tbody tr:hover td { background: rgba(216, 180, 142, .05); }

        .ad-name { color: var(--ivory); font-weight: 500; font-size: 1.25rem; }
        .ad-sub { color: var(--mauve); font-size: 1rem; margin-top: .3rem; }
        .ad-nowrap { white-space: nowrap; }
        .ad-price {
            font-family: var(--display);
            font-size: 1.65rem;
            font-weight: 600;
            color: var(--champagne);
            white-space: nowrap;
        }

        .ad-form { display: flex; align-items: center; gap: .8rem; }

        .ad-select {
            padding: .85rem 2.5rem .85rem 1.15rem;
            border-radius: .7rem;
            border: 1px solid var(--line);
            background-color: var(--wine-deep);
            color: var(--ivory);
            color-scheme: dark;
            font-size: 1.05rem;
        }
        .ad-select:focus {
            outline: none;
            border-color: var(--champagne);
            box-shadow: 0 0 0 1px var(--champagne);
        }

        .ad-btn {
            padding: .95rem 1.7rem;
            border: 0;
            border-radius: .7rem;
            cursor: pointer;
            font-size: .85rem;
            font-weight: 600;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: var(--wine-deep);
            background: linear-gradient(135deg, var(--champagne-soft), var(--champagne));
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .ad-btn:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(216, 180, 142, .25); }

        .ad-empty { padding: 4rem 1rem !important; text-align: center; color: var(--mauve) !important; }

        /* HP: tabel berubah jadi kartu ramping */
        @media (max-width: 760px) {
            .ad { padding: 1.5rem 0 3rem; }
            .ad-alert { padding: .75rem 1rem; font-size: .8rem; margin-bottom: 1rem; }

            .ad-wrap { overflow: visible; border: 0; background: transparent; box-shadow: none; }
            .ad-table { min-width: 0; display: block; font-size: .8rem; }
            .ad-table thead { display: none; }
            .ad-table tbody { display: grid; gap: .65rem; }

            .ad-table tbody tr {
                display: block;
                padding: .15rem .9rem;
                border-radius: .7rem;
                border: 1px solid var(--line);
                background: linear-gradient(160deg, var(--wine-soft), var(--wine));
            }
            .ad-table tbody tr:hover td { background: transparent; }

            .ad-table tbody td {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: .75rem;
                padding: .5rem 0;
                text-align: right;
                white-space: normal;
                border-bottom: 1px solid var(--line);
            }
            .ad-table tbody tr:last-child td { border-bottom: 1px solid var(--line); }
            .ad-table tbody tr td:last-child { border-bottom: 0; }

            .ad-table tbody td::before {
                content: attr(data-label);
                flex: none;
                font-size: .58rem;
                letter-spacing: .2em;
                text-transform: uppercase;
                color: var(--champagne);
                text-align: left;
                padding-top: .15rem;
            }

            .ad-name { font-size: .85rem; }
            .ad-sub { font-size: .7rem; margin-top: .1rem; }
            .ad-price { font-size: 1rem; }

            .ad-table tbody td.ad-status-cell {
                flex-direction: column;
                align-items: stretch;
                gap: .4rem;
                text-align: left;
            }
            .ad-form { width: 100%; gap: .4rem; }
            .ad-select { flex: 1; padding: .4rem 1.75rem .4rem .6rem; font-size: .78rem; }
            .ad-btn { padding: .45rem .85rem; font-size: .62rem; }

            .ad-table tbody td.ad-empty {
                display: block;
                text-align: center;
                border-bottom: 0;
                padding: 1.5rem .5rem !important;
            }
            .ad-table tbody td.ad-empty::before { display: none; }
        }
    </style>

    <div class="ad">
        <div class="ad-container">

            @if (session('status'))
                <div class="ad-alert">{{ session('status') }}</div>
            @endif

            <div class="ad-wrap">
                <table class="ad-table">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Jadwal</th>
                            <th>Fotografer</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $booking)
                            <tr>
                                <td data-label="Pelanggan">
                                    <div>
                                        <div class="ad-name">{{ $booking->user->name }}</div>
                                        <div class="ad-sub">{{ $booking->user->email }}</div>
                                    </div>
                                </td>
                                <td data-label="Paket">{{ $booking->package->name }}</td>
                                <td data-label="Jadwal" class="ad-nowrap">
                                    <div>
                                        {{ $booking->booking_date->format('d/m/Y') }}
                                        <div class="ad-sub">
                                            {{ \Carbon\Carbon::parse($booking->start_time)->format('H.i') }}
                                            &ndash; {{ \Carbon\Carbon::parse($booking->end_time)->format('H.i') }}
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Fotografer">{{ $booking->photographer?->name ?? '-' }}</td>
                                <td data-label="Total" class="ad-price">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                <td data-label="Status" class="ad-status-cell">
                                    <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="ad-form">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="ad-select">
                                            @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                                <option value="{{ $status }}" @selected($booking->status === $status)>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="ad-btn">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="ad-empty">Belum ada booking.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>