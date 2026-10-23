<x-app-layout>
    <x-slot name="header">
        <h2>Edit Fotografer</h2>
    </x-slot>

    <style>
        .fp { padding: 3rem 0 5rem; }

        .fp-hero { text-align: center; margin-bottom: 2.25rem; }
        .fp-eyebrow {
            font-size: .75rem;
            letter-spacing: .35em;
            text-transform: uppercase;
            color: var(--champagne);
        }
        .fp-title {
            font-family: var(--display);
            font-size: clamp(2rem, 6vw, 3rem);
            font-weight: 500;
            line-height: 1.05;
            color: var(--ivory);
            margin-top: .6rem;
        }
        .fp-title em { font-style: italic; color: var(--champagne); }
        .fp-divider {
            width: 90px;
            height: 1px;
            margin: 1.5rem auto 0;
            background: linear-gradient(90deg, transparent, var(--champagne), transparent);
        }

        .fp-card {
            padding: 2rem;
            border-radius: 1rem;
            border: 1px solid var(--line);
            background: linear-gradient(160deg, var(--wine-soft), var(--wine));
            box-shadow: 0 14px 40px rgba(0, 0, 0, .3);
        }

        /* Gaya untuk isian dari _form (label, input, textarea, select, error) */
        .fp-card label {
            display: block;
            font-size: .7rem;
            letter-spacing: .25em;
            text-transform: uppercase;
            color: var(--champagne);
            margin-bottom: .5rem;
        }
        .fp-card input:not([type="checkbox"]):not([type="radio"]),
        .fp-card textarea,
        .fp-card select {
            display: block;
            width: 100%;
            padding: .9rem 1rem;
            border-radius: .6rem;
            border: 1px solid var(--line);
            background-color: var(--wine-deep);
            color: var(--ivory);
            color-scheme: dark;
            font-size: 1rem;
        }
        .fp-card input:not([type="checkbox"]):not([type="radio"]):focus,
        .fp-card textarea:focus,
        .fp-card select:focus {
            outline: none;
            border-color: var(--champagne);
            box-shadow: 0 0 0 1px var(--champagne);
        }
        .fp-card input::placeholder,
        .fp-card textarea::placeholder { color: var(--mauve); opacity: .6; }
        .fp-card input[type="checkbox"],
        .fp-card input[type="radio"] {
            width: 1.15rem;
            height: 1.15rem;
            accent-color: var(--champagne);
            cursor: pointer;
        }
        .fp-card input[type="checkbox"] + label,
        .fp-card label:has(input[type="checkbox"]) {
            display: inline;
            margin: 0;
            letter-spacing: normal;
            text-transform: none;
            font-size: .95rem;
            color: var(--champagne-soft);
        }
        .fp-card .text-red-600,
        .fp-card .text-red-500 { color: #f4a6a6; }
        .fp-card .text-sm.text-gray-600,
        .fp-card .text-gray-500 { color: var(--mauve); }

        .fp-actions {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        .fp-submit {
            flex: 1;
            min-width: 10rem;
            padding: 1.05rem 1.5rem;
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
        .fp-submit:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(216, 180, 142, .25); }

        .fp-cancel {
            font-size: .8rem;
            letter-spacing: .2em;
            text-transform: uppercase;
            text-decoration: none;
            color: var(--mauve);
            transition: color .2s ease;
        }
        .fp-cancel:hover { color: var(--champagne-soft); }

        /* HP: kotak lebih ramping, ukuran tulisan tetap */
        @media (max-width: 640px) {
            .fp { padding: 1.25rem 0 2.5rem; }
            .fp > div { padding-left: .75rem; padding-right: .75rem; }

            .fp-hero { margin-bottom: 1.25rem; }
            .fp-divider { margin-top: 1rem; }

            .fp-card { padding: .9rem; border-radius: .8rem; }

            .fp-card label { margin-bottom: .35rem; }
            .fp-card input:not([type="checkbox"]):not([type="radio"]),
            .fp-card textarea,
            .fp-card select { padding: .55rem .75rem; border-radius: .5rem; }

            .fp-actions { margin-top: 1.25rem; gap: .9rem; }
            .fp-submit { padding: .75rem 1rem; min-width: 8rem; }
        }
    </style>

    <div class="fp">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="fp-hero">
                <div class="fp-eyebrow">Admin</div>
                <h1 class="fp-title">Edit <em>fotografer</em></h1>
                <div class="fp-divider"></div>
            </div>

            <div class="fp-card">
                <form action="{{ route('admin.photographers.update', $photographer) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Form yang sama dengan halaman tambah, kini terisi data fotografer --}}
                    @include('admin.photographers._form')

                    <div class="fp-actions">
                        <button type="submit" class="fp-submit">Simpan Perubahan</button>
                        <a href="{{ route('admin.photographers.index') }}" class="fp-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>