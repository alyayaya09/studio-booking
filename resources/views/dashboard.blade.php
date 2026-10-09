<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (Auth::user()->is_admin)
                <div class="grid gap-4 grid-cols-2 lg:grid-cols-3">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <p class="text-sm text-gray-500">Total Booking</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['total'] }}</p>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <p class="text-sm text-gray-500">Menunggu Konfirmasi</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['pending'] }}</p>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <p class="text-sm text-gray-500">Sudah Dikonfirmasi</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['confirmed'] }}</p>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <p class="text-sm text-gray-500">Pendapatan</p>
                        <p class="text-2xl font-semibold text-gray-800">
                            Rp {{ number_format($stats['revenue'], 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <p class="text-sm text-gray-500">Paket</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['packages'] }}</p>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg p-6">
                        <p class="text-sm text-gray-500">Fotografer</p>
                        <p class="text-2xl font-semibold text-gray-800">{{ $stats['photographers'] }}</p>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-semibold text-gray-800">Booking Terbaru</h3>
                        <a href="{{ route('admin.bookings.index') }}" class="text-sm text-indigo-600 underline">Lihat semua</a>
                    </div>

                    @forelse ($latest as $booking)
                        <div class="flex items-center justify-between border-t py-3 text-sm">
                            <div>
                                <p class="font-medium text-gray-800">{{ $booking->user->name }}</p>
                                <p class="text-gray-500">{{ $booking->package->name }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-600">{{ $booking->booking_date->format('d/m/Y') }}</p>
                                <p class="text-gray-500">{{ ucfirst($booking->status) }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Belum ada booking.</p>
                    @endforelse
                </div>
            @else
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-gray-800 mb-2">Halo, {{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-600">Total booking kamu: {{ $myTotal }}</p>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Sesi Foto Berikutnya</h3>

                    @if ($upcoming)
                        <p class="font-medium text-gray-800">{{ $upcoming->package->name }}</p>
                        <p class="text-sm text-gray-600">
                            {{ $upcoming->booking_date->translatedFormat('l, d F Y') }},
                            {{ \Carbon\Carbon::parse($upcoming->start_time)->format('H.i') }}
                            - {{ \Carbon\Carbon::parse($upcoming->end_time)->format('H.i') }}
                        </p>
                        <p class="text-sm text-gray-500">Fotografer: {{ $upcoming->photographer->name }}</p>
                        <p class="text-sm text-gray-500">Status: {{ ucfirst($upcoming->status) }}</p>
                    @else
                        <p class="text-sm text-gray-600">
                            Belum ada sesi yang akan datang.
                            <a href="{{ route('booking.create') }}" class="text-indigo-600 underline">Pesan sesi foto</a>.
                        </p>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>