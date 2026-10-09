<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Booking Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @forelse ($bookings as $booking)
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $booking->package->name }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ $booking->booking_date->translatedFormat('l, d F Y') }},
                                {{ \Carbon\Carbon::parse($booking->start_time)->format('H.i') }}
                                - {{ \Carbon\Carbon::parse($booking->end_time)->format('H.i') }}
                            </p>
                            <p class="text-sm text-gray-500">Fotografer: {{ $booking->photographer->name }}</p>
                            @if ($booking->notes)
                                <p class="mt-1 text-sm text-gray-500">Catatan: {{ $booking->notes }}</p>
                            @endif
                        </div>

                        <div class="text-right">
                            <span class="inline-block rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                {{ ucfirst($booking->status) }}
                            </span>
                            <p class="mt-2 font-semibold text-gray-800">
                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-sm text-gray-600">
                    Kamu belum punya booking.
                    <a href="{{ route('booking.create') }}" class="text-indigo-600 underline">Pesan sesi foto sekarang</a>.
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>