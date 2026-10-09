<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Booking
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('status'))
                <div class="bg-green-100 border border-green-300 text-green-800 rounded-lg p-4 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-left text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Pelanggan</th>
                            <th class="px-4 py-3">Paket</th>
                            <th class="px-4 py-3">Jadwal</th>
                            <th class="px-4 py-3">Fotografer</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse ($bookings as $booking)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-800">{{ $booking->user->name }}</div>
                                    <div class="text-gray-500">{{ $booking->user->email }}</div>
                                </td>
                                <td class="px-4 py-3">{{ $booking->package->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    {{ $booking->booking_date->format('d/m/Y') }}<br>
                                    {{ \Carbon\Carbon::parse($booking->start_time)->format('H.i') }}
                                    - {{ \Carbon\Carbon::parse($booking->end_time)->format('H.i') }}
                                </td>
                                <td class="px-4 py-3">{{ $booking->photographer->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3">
                                    <form method="POST" action="{{ route('admin.bookings.update', $booking) }}" class="flex items-center gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="border-gray-300 rounded-md shadow-sm text-sm">
                                            @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                                <option value="{{ $status }}" @selected($booking->status === $status)>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <x-primary-button>Simpan</x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500">Belum ada booking.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>