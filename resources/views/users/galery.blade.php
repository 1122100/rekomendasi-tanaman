@extends('layouts.appuser')

@section('content')
<div class="container mx-auto px-4 py-8 mt-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-green-800">Galeri Tanaman</h1>
        <div class="relative">
            <input type="text" id="searchInput" placeholder="Cari tanaman..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            <button class="absolute right-0 top-0 h-full px-3 text-gray-500">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="plantGrid">
        @forelse($tanaman as $plant)
        <div class="plant-card bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300" data-name="{{ strtolower($plant->nama) }}">
            <div class="relative h-48 overflow-hidden">
                @if($plant->gambar)
                    <img src="{{ asset('storage/tanaman/' . $plant->gambar) }}" alt="{{ $plant->nama }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-leaf text-green-500 text-4xl"></i>
                    </div>
                @endif
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                    <h3 class="text-white font-semibold text-lg">{{ $plant->nama }}</h3>
                </div>
            </div>
            <div class="p-4">
                <div class="flex flex-col gap-1 mb-3">
                    @forelse($plant->fuzzyRules as $rule)
                        <div class="flex flex-wrap gap-2">
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                {{ $rule->parameterSuhu->label ?? 'N/A' }}
                            </span>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                {{ $rule->parameterKelembapan->label ?? 'N/A' }}
                            </span>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                {{ $rule->parameterCahaya->label ?? 'N/A' }}
                            </span>
                        </div>
                    @empty
                        <span class="text-gray-400 text-xs">Belum ada aturan fuzzy</span>
                    @endforelse
                </div>

                <p class="text-gray-600 text-sm line-clamp-2 mb-3">
                    {{ Str::limit($plant->deskripsi ?? 'Tidak ada deskripsi', 100) }}
                </p>
                <a href="{{ route('tanaman.detail', $plant->id) }}" class="inline-block w-full text-center py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300">
                    Detail Tanaman
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-10">
            <div class="text-5xl text-gray-300 mb-4">
                <i class="fas fa-seedling"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-500">Belum ada data tanaman</h3>
            <p class="text-gray-400 mt-2">Data tanaman akan ditampilkan di sini</p>
        </div>
        @endforelse
    </div>

    <div id="noResults" class="hidden text-center py-10">
        <div class="text-5xl text-gray-300 mb-4">
            <i class="fas fa-search"></i>
        </div>
        <h3 class="text-xl font-medium text-gray-500">Tidak ada tanaman yang ditemukan</h3>
        <p class="text-gray-400 mt-2">Coba kata kunci pencarian lain</p>
    </div>

    <div class="mt-8">
        {{ $tanaman->links() }}
    </div>
    <div class="pt-20">
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const plantCards = document.querySelectorAll('.plant-card');
        const plantGrid = document.getElementById('plantGrid');
        const noResults = document.getElementById('noResults');

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            let foundResults = false;

            plantCards.forEach(card => {
                const plantName = card.dataset.name;
                if (plantName.includes(searchTerm)) {
                    card.classList.remove('hidden');
                    foundResults = true;
                } else {
                    card.classList.add('hidden');
                }
            });

            if (foundResults) {
                plantGrid.classList.remove('hidden');
                noResults.classList.add('hidden');
            } else {
                plantGrid.classList.add('hidden');
                noResults.classList.remove('hidden');
            }
        });
    });
</script>
@endsection