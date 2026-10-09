<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Paket Foto
            </h2>
            <a href="{{ route('admin.packages.create') }}"
               class="px-4 py-2 bg-gray-800 text-white text-sm rounded-md hover:bg-gray-700">
                + Tambah Paket
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
                            <th class="px-4 py-3">Harga</th>
                            <th class="px-4 py-3">Durasi</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($packages as $package)
                            <tr>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $package->name }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">{{ $package->duration_minutes }} menit</td>
                                <td class="px-4 py-3">
                                    @if ($package->is_active)
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.packages.edit', $package) }}"
                                       class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST"
                                          class="inline"
                                          onsubmit="return confirm('Hapus paket ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-3 text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                                    Belum ada paket. Klik "Tambah Paket" untuk membuat yang pertama.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $packages->links() }}</div>
        </div>
    </div>
</x-app-layout>