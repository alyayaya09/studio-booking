<x-app-layout>
    <x-slot name="header">
        <h2>Tambah Paket</h2>
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

        .fp-field { margin-bottom: 1.5rem; }

        .fp-label {
            display: block;
            font-size: .7rem;
            letter-spacing: .25em;
            text-transform: uppercase;
            color: var(--champagne);
            margin-bottom: .5rem;
        }
        .fp-input {
            display: block;
            width: 100%;
            padding: .9rem 1rem;
            border-radius: .6rem;
            border: 1px solid var(--line);
            background: var(--wine-deep);
            color: var(--ivory);
            color-scheme: dark;
            font-size: 1rem;
        }
        .fp-input:focus {
            outline: none;
            border-color: var(--champagne);
            box-shadow: 0 0 0 1px var(--champagne);
        }
        .fp-input::placeholder { color: var(--mauve); opacity: .6; }
        textarea.fp-input { resize: vertical; min-height: 6rem; }

        .fp-error { margin-top: .5rem; font-size: .85rem; color: #f4a6a6; }

        .fp-check {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1rem 1.25rem;
            border-radius: .6rem;
            border: 1px solid var(--line);
            background: rgba(216, 180, 142, .06);
            cursor: pointer;
        }
        .fp-check input {
            width: 1.15rem;
            height: 1.15rem;
            accent-color: var(--champagne);
            cursor: pointer;
        }
        .fp-check span { color: var(--champagne-soft); font-size: .95rem; }

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

            .fp-field { margin-bottom: .9rem; }
            .fp-label { margin-bottom: .35rem; }
            .fp-input { padding: .55rem .75rem; border-radius: .5rem; }
            textarea.fp-input { min-height: 4.5rem; }

            .fp-check { padding: .6rem .85rem; }

            .fp-actions { margin-top: 1.25rem; gap: .9rem; }
            .fp-submit { padding: .75rem 1rem; min-width: 8rem; }
        }
    </style>

    <div class="fp">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="fp-hero">
                <div class="fp-eyebrow">Admin</div>
                <h1 class="fp-title">Paket <em>baru</em></h1>
                <div class="fp-divider"></div>
            </div>

            <div class="fp-card">
                <form action="{{ route('admin.packages.store') }}" method="POST">
                    @csrf

                    <div class="fp-field">
                        <label class="fp-label" for="name">Nama paket</label>
                        <input class="fp-input" type="text" name="name" id="name" required maxlength="255"
                               value="{{ old('name') }}">
                        @error('name') <p class="fp-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="fp-field">
                        <label class="fp-label" for="description">Deskripsi</label>
                        <textarea class="fp-input" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                        @error('description') <p class="fp-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="fp-field">
                        <label class="fp-label" for="price">Harga (Rp)</label>
                        <input class="fp-input" type="number" name="price" id="price" required min="0"
                               value="{{ old('price') }}">
                        @error('price') <p class="fp-error">{{ $message }}</p> @enderror
                    </div>

                    <div class="fp-field">
                        <label class="fp-label" for="duration_minutes">Durasi (menit)</label>
                        <input class="fp-input" type="number" name="duration_minutes" id="duration_minutes" required
                               min="15" max="480" step="15"
                               value="{{ old('duration_minutes', 60) }}">
                        @error('duration_minutes') <p class="fp-error">{{ $message }}</p> @enderror
                    </div>

                    <label class="fp-check" for="is_active">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                               @checked(old('is_active', true))>
                        <span>Paket aktif</span>
                    </label>

                    <div class="fp-actions">
                        <button type="submit" class="fp-submit">Simpan</button>
                        <a href="{{ route('admin.packages.index') }}" class="fp-cancel">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>