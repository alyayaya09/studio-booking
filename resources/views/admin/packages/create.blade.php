<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Paket
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.packages.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium mb-1">Nama paket</label>
                        <input type="text" name="name" id="name" required maxlength="255"
                               value="{{ old('name') }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full rounded-md border border-gray-300 px-3 py-2">{{ old('description') }}</textarea>
                        @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium mb-1">Harga (Rp)</label>
                        <input type="number" name="price" id="price" required min="0"
                               value="{{ old('price') }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2">
                        @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="duration_minutes" class="block text-sm font-medium mb-1">Durasi (menit)</label>
                        <input type="number" name="duration_minutes" id="duration_minutes" required
                               min="15" max="480" step="15"
                               value="{{ old('duration_minutes', 60) }}"
                               class="w-full rounded-md border border-gray-300 px-3 py-2">
                        @error('duration_minutes') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                               @checked(old('is_active', true)) class="rounded border-gray-300">
                        <label for="is_active" class="text-sm">Paket aktif</label>
                    </div>

                    <div class="flex items-center gap-3">
                        <button type="submit"
                                class="px-4 py-2 bg-gray-800 text-white text-sm rounded-md hover:bg-gray-700">
                            Simpan
                        </button>
                        <a href="{{ route('admin.packages.index') }}"
                           class="text-sm text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>