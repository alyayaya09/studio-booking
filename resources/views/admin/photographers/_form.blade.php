{{-- Form bersama untuk tambah & edit fotografer. $photographer kosong saat tambah. --}}
@php
    $photographer = $photographer ?? null;
    // Saat validasi gagal pakai input lama; kalau tidak, pakai data fotografer (default: aktif)
    $isActive = old() ? old('is_active') : ($photographer?->is_active ?? true);
@endphp

<div class="space-y-4">
    <div>
        <x-input-label for="name" value="Nama Fotografer" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                      :value="old('name', $photographer?->name)" required />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <x-input-label for="phone" value="Telepon" />
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full"
                          :value="old('phone', $photographer?->phone)" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                          :value="old('email', $photographer?->email)" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
    </div>

    <label class="inline-flex items-center">
        <input type="checkbox" name="is_active" value="1" @checked($isActive)
               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
        <span class="ms-2 text-sm text-gray-600">Fotografer aktif (bisa ditugaskan ke booking)</span>
    </label>
</div>