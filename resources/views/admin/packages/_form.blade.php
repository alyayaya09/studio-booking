{{-- Form bersama untuk tambah & edit paket. $package kosong saat tambah. --}}
@php
    $package = $package ?? null;
    // Saat validasi gagal pakai input lama; kalau tidak, pakai data paket (default: aktif)
    $isActive = old() ? old('is_active') : ($package?->is_active ?? true);
@endphp

<div class="space-y-4">
    <div>
        <x-input-label for="name" value="Nama Paket" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      :value="old('name', $package?->name)" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="description" value="Deskripsi" />
        <textarea id="description" name="description" rows="4"
                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $package?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <x-input-label for="price" value="Harga (Rp)" />
            <x-text-input id="price" name="price" type="number" min="0" class="mt-1 block w-full"
                          :value="old('price', $package?->price)" required />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="duration_minutes" value="Durasi (menit)" />
            <x-text-input id="duration_minutes" name="duration_minutes" type="number" min="1" class="mt-1 block w-full"
                          :value="old('duration_minutes', $package?->duration_minutes)" required />
            <x-input-error :messages="$errors->get('duration_minutes')" class="mt-2" />
        </div>
    </div>

    <label class="inline-flex items-center">
        <input type="checkbox" name="is_active" value="1" @checked($isActive)
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
        <span class="ms-2 text-sm text-gray-600">Paket aktif (bisa dipesan customer)</span>
    </label>
</div>