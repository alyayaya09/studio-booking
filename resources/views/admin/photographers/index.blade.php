<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Fotografer
            </h2>
            <a href="{{ route('admin.photographers.create') }}"
               class="px-4 py-2 bg-gray-800 text-white text-sm rounded-md hover:bg-gray-700">
                + Tambah Fotografer
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Pesan sukses / error --}}
            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Telepon</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($photographers as $photographer)
                            <tr>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $photographer->name }}</td>
                                <td class="px-4 py-3">{{ $photographer->phone ?? '-' }}</td>
                                <td class="px-4 py-3">{{ $photographer->email ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if ($photographer->is_active)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.photographers.edit', $photographer) }}"
                                       class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.photographers.destroy', $photographer) }}" method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Hapus fotografer ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-3 text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada fotografer. Klik "Tambah Fotografer" untuk membuat yang pertama.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $photographers->links() }}</div>
        </div>
    </div>
</x-app-layout>