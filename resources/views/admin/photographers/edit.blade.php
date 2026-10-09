<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Fotografer
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.photographers.update', $photographer) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Form yang sama dengan halaman tambah, kini terisi data fotografer --}}
                    @include('admin.photographers._form')

                    <div class="mt-6 flex items-center gap-3">
                        <x-primary-button>Simpan Perubahan</x-primary-button>
                        <a href="{{ route('admin.photographers.index') }}"
                           class="text-sm text-gray-600 hover:underline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>