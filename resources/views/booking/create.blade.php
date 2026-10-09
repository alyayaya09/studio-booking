<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pesan Sesi Foto
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-100 border border-green-300 text-green-800 rounded-lg p-4 text-sm">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Daftar Paket</h3>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($packages as $package)
                        <div class="border rounded-lg p-4">
                            <h4 class="font-semibold text-gray-800">{{ $package->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $package->description }}</p>
                            <p class="mt-2 text-sm text-gray-600">{{ $package->duration_minutes }} menit</p>
                            <p class="font-semibold text-gray-800">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Form Pemesanan</h3>

                <form method="POST" action="{{ route('booking.store') }}" class="space-y-4">
                    @csrf

                    <div>
                        <x-input-label for="package_id" value="Paket" />
                        <select id="package_id" name="package_id" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">-- Pilih paket --</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}" @selected(old('package_id') == $package->id)>
                                    {{ $package->name }} ({{ $package->duration_minutes }} menit) - Rp {{ number_format($package->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('package_id')" class="mt-2" />
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="booking_date" value="Tanggal" />
                            <x-text-input id="booking_date" name="booking_date" type="date" class="mt-1 block w-full"
                                :value="old('booking_date')" min="{{ now()->toDateString() }}" required />
                            <x-input-error :messages="$errors->get('booking_date')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="start_time" value="Jam mulai" />
                            <x-text-input id="start_time" name="start_time" type="time" class="mt-1 block w-full"
                                :value="old('start_time')" required />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="notes" value="Catatan (opsional)" />
                        <textarea id="notes" name="notes" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>

                    <p class="text-sm text-gray-500">
                        Jam operasional: Senin-Sabtu 09.00-20.00, Minggu 10.00-17.00. Fotografer ditentukan oleh studio.
                    </p>

                    <x-primary-button>Pesan Sekarang</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>