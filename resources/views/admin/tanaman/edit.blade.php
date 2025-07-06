<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Tanaman: {{ $tanaman->nama }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.tanaman.update', $tanaman) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="nama" value="Nama Tanaman" />
                            <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full"
                                value="{{ old('nama', $tanaman->nama) }}" required />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="deskripsi" value="Deskripsi" />
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('deskripsi', $tanaman->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="cara_perawatan" value="Cara Perawatan" />
                            <textarea id="cara_perawatan" name="cara_perawatan" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>{{ old('cara_perawatan', $tanaman->cara_perawatan) }}</textarea>
                            <x-input-error :messages="$errors->get('cara_perawatan')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="gambar" value="Gambar Tanaman" />

                            @if ($tanaman->gambar)
                                <div class="mt-2 mb-3">
                                    <img src="{{ asset('storage/tanaman/' . $tanaman->gambar) }}"
                                        alt="{{ $tanaman->nama }}" class="h-32 w-auto object-cover rounded">
                                </div>
                            @endif

                            <input type="file" id="gambar" name="gambar"
                                class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100">
                            <div class="mt-1 text-sm text-gray-500">
                                Biarkan kosong jika tidak ingin mengubah gambar
                            </div>
                            <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-secondary-button type="button" onclick="window.history.back();" class="mr-3">
                                Batal
                            </x-secondary-button>
                            <x-primary-button>
                                Simpan Perubahan
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>