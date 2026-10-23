<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4 flex-wrap">
            <h2>Fotografer</h2>
            <a href="{{ route('admin.photographers.create') }}" class="pk-add">+ Tambah Fotografer</a>
        </div>
    </x-slot>

    <style>
        .pk-add {
            display: inline-block;
            padding: .8rem 1.5rem;
            border-radius: .6rem;
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .2em;
            text-transform: uppercase;
            text-decoration: none;
            color: var(--wine-deep);
            background: linear-gradient(135deg, var(--champagne-soft), var(--champagne));
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .pk-add:hover { transform: translateY(-2px); box-shadow: 0 10px 24px rgba(216, 180, 142, .25); }

        .ad { padding: 3rem 0 6rem; }

        .ad-container { max-width: 96rem; margin: 0 auto; padding: 0 1rem; }
        @media (min-width: 1024px) { .ad-container { padding: 0 2.5rem; } }

        .ad-alert {
            margin-bottom: 1.75rem;
            padding: 1.2rem 1.6rem;
            border-radius: .7rem;
            border: 1px solid var(--champagne);
            background: rgba(216, 180, 142, .12);
            color: var(--champagne-soft);
            font-size: 1.05rem;
        }
        .ad-alert.is-error {
            border-color: rgba(244, 166, 166, .55);
            background: rgba(244, 166, 166, .10);
            color: #f4a6a6;
        }

        .ad-wrap {
            overflow-x: auto;
            border-radius: 1.1rem;
            border: 1px solid var(--line);
            background: var(--wine);
            box-shadow: 0 14px 40px rgba(0, 0, 0, .3);
        }

        .ad-table { width: 100%; min-width: 900px; border-collapse: collapse; font-size: 1.15rem; }

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
        .ad-table thead th.ad-right { text-align: right; }

        .ad-table tbody td {
            padding: 1.9rem 2rem;
            vertical-align: middle;
            color: var(--champagne-soft);
            border-bottom: 1px solid var(--line);
        }
        .ad-table tbody tr:last-child td { border-bottom: 0; }
        .ad-table tbody tr:hover td { background: rgba(216, 180, 142, .05); }

        .ad-name { color: var(--ivory); font-weight: 500; font-size: 1.25rem; }
        .ad-nowrap { white-space: nowrap; }
        .ad-break { word-break: break-word; }

        .ad-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .4rem 1rem;
            border-radius: 999px;
            border: 1px solid var(--line);
            font-size: .75rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            white-space: nowrap;
        }
        .ad-badge::before {
            content: "";
            width: .5rem;
            height: .5rem;
            border-radius: 999px;
            background: currentColor;
            box-shadow: 0 0 10px currentColor;
        }
        .ad-badge.is-on  { color: #a9dcb8; border-color: rgba(169, 220, 184, .45); background: rgba(169, 220, 184, .10); }
        .ad-badge.is-off { color: var(--mauve); border-color: var(--line); background: rgba(179, 148, 153, .08); }

        .ad-actions { display: flex; justify-content: flex-end; align-items: center; gap: .75rem; }
        .ad-actions form { margin: 0; }

        .ad-edit,
        .ad-del {
            display: inline-block;
            padding: .7rem 1.3rem;
            border-radius: .6rem;
            font-size: .8rem;
            font-weight: 600;
            letter-spacing: .15em;
            text-transform: uppercase;
            text-decoration: none;
            cursor: pointer;
            background: transparent;
            transition: background .2s ease, color .2s ease, border-color .2s ease;
        }
        .ad-edit { color: var(--champagne); border: 1px solid var(--champagne); }
        .ad-edit:hover { background: var(--champagne); color: var(--wine-deep); }
        .ad-del { color: #f4a6a6; border: 1px solid rgba(244, 166, 166, .5); }
        .ad-del:hover { background: #f4a6a6; color: var(--wine-deep); border-color: #f4a6a6; }

        .ad-empty { padding: 4rem 1rem !important; text-align: center; color: var(--mauve) !important; }

        /* Pagination bawaan Breeze, disesuaikan ke tema gelap */
        .ad-pager { margin-top: 1.75rem; }
        .ad-pager .bg-white { background: var(--wine) !important; }
        .ad-pager .text-gray-700,
        .ad-pager .text-gray-600,
        .ad-pager .text-gray-500 { color: var(--champagne-soft) !important; }
        .ad-pager .border-gray-300 { border-color: var(--line) !important; }
        .ad-pager a:hover { background: var(--wine-soft) !important; }

        /* HP: tabel berubah jadi kartu ramping */
        @media (max-width: 760px) {
            .ad { padding: 1.5rem 0 3rem; }
            .ad-alert { padding: .75rem 1rem; font-size: .8rem; margin-bottom: 1rem; }
            .pk-add { padding: .55rem 1rem; font-size: .65rem; }

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
                align-items: center;
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
            }

            .ad-name { font-size: .9rem; }
            .ad-badge { padding: .25rem .7rem; font-size: .6rem; }

            .ad-table tbody td.ad-act-cell { justify-content: flex-end; }
            .ad-table tbody td.ad-act-cell::before { display: none; }
            .ad-edit, .ad-del { padding: .45rem .9rem; font-size: .62rem; }

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

            {{-- Pesan sukses / error --}}
            @if (session('success'))
                <div class="ad-alert">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="ad-alert is-error">{{ session('error') }}</div>
            @endif

            <div class="ad-wrap">
                <table class="ad-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th class="ad-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($photographers as $photographer)
                            <tr>
                                <td data-label="Nama" class="ad-name">{{ $photographer->name }}</td>
                                <td data-label="Telepon" class="ad-nowrap">{{ $photographer->phone ?? '-' }}</td>
                                <td data-label="Email" class="ad-break">{{ $photographer->email ?? '-' }}</td>
                                <td data-label="Status">
                                    @if ($photographer->is_active)
                                        <span class="ad-badge is-on">Aktif</span>
                                    @else
                                        <span class="ad-badge is-off">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="ad-act-cell">
                                    <div class="ad-actions">
                                        <a href="{{ route('admin.photographers.edit', $photographer) }}" class="ad-edit">Edit</a>
                                        <form action="{{ route('admin.photographers.destroy', $photographer) }}" method="POST"
                                              onsubmit="return confirm('Hapus fotografer ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="ad-del">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="ad-empty">
                                    Belum ada fotografer. Klik "Tambah Fotografer" untuk membuat yang pertama.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="ad-pager">{{ $photographers->links() }}</div>
        </div>
    </div>
</x-app-layout>