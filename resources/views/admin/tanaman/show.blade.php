<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Tanaman: {{ $tanaman->nama }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <x-primary-link href="{{ route('admin.tanaman.index') }}">
                    Kembali ke Daftar
                </x-primary-link>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            @if ($tanaman->gambar)
                                <img src="{{ asset('storage/tanaman/' . $tanaman->gambar) }}" 
                                    alt="{{ $tanaman->nama }}" class="w-full h-auto rounded-lg">
                            @else
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg">
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="md:col-span-2">
                            <h3 class="text-lg font-semibold mb-2">{{ $tanaman->nama }}</h3>
                            
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700">Deskripsi:</h4>
                                <p class="mt-1 text-gray-600">{{ $tanaman->deskripsi }}</p>
                            </div>
                            
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700">Cara Perawatan:</h4>
                                <p class="mt-1 text-gray-600">{{ $tanaman->cara_perawatan }}</p>
                            </div>
                            
                            @if($tanaman->jenis)
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700">Jenis Tanaman:</h4>
                                <p class="mt-1 text-gray-600">{{ $tanaman->jenis }}</p>
                            </div>
                            @endif
                            
                            @if($tanaman->asal)
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700">Asal Tanaman:</h4>
                                <p class="mt-1 text-gray-600">{{ $tanaman->asal }}</p>
                            </div>
                            @endif
                            
                            @if($tanaman->manfaat)
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700">Manfaat Tanaman:</h4>
                                <p class="mt-1 text-gray-600">{{ $tanaman->manfaat }}</p>
                            </div>
                            @endif
                            
                            <div class="mb-4">
                                <h4 class="font-medium text-gray-700">Aturan Fuzzy:</h4>
                                <div class="mt-2">
                                    @if($tanaman->fuzzyRules->count() > 0)
                                        <div class="bg-gray-50 p-3 rounded">
                                            <ul class="list-disc list-inside">
                                                @foreach($tanaman->fuzzyRules as $rule)
                                                    <li class="mb-2">
                                                        IF Suhu = <span class="font-medium text-red-600">{{ $rule->parameterSuhu ? $rule->parameterSuhu->label : 'Tidak ada' }}</span> 
                                                        AND Kelembapan = <span class="font-medium text-blue-600">{{ $rule->parameterKelembapan ? $rule->parameterKelembapan->label : 'Tidak ada' }}</span> 
                                                        AND Cahaya = <span class="font-medium text-green-600">{{ $rule->parameterCahaya ? $rule->parameterCahaya->label : 'Tidak ada' }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <p class="text-gray-500">Belum ada aturan fuzzy untuk tanaman ini</p>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex space-x-4 mt-6">
                                <x-primary-link href="{{ route('admin.tanaman.edit', $tanaman) }}">
                                    Edit Tanaman
                                </x-primary-link>
                                
                                <form action="{{ route('admin.tanaman.destroy', $tanaman) }}" method="POST" 
                                    onsubmit="return confirm('Yakin ingin menghapus tanaman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit">
                                        Hapus Tanaman
                                    </x-danger-button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>