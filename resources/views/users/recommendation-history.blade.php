@extends('layouts.appuser')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Rekomendasi</h1>
            <a href="{{ route('rekomendasi') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">
                <i class="fas fa-plus mr-2"></i> Rekomendasi Baru
            </a>
        </div>

        @if(count($history) > 0)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50 text-left">
                                <th class="px-6 py-3 text-gray-700 font-semibold">Tanggal</th>
                                <th class="px-6 py-3 text-gray-700 font-semibold">Parameter Input</th>
                                <th class="px-6 py-3 text-gray-700 font-semibold">Hasil Rekomendasi</th>
                                <th class="px-6 py-3 text-gray-700 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($history as $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-gray-800">{{ $item->created_at->format('d M Y') }}</div>
                                        <div class="text-gray-500 text-sm">{{ $item->created_at->format('H:i') }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            @if(isset($item->input_data['suhu']))
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                                    Suhu: {{ ucfirst($item->input_data['suhu']) }}
                                                </span>
                                            @endif

                                            @if(isset($item->input_data['kelembapan']))
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                                    Kelembapan: {{ ucfirst($item->input_data['kelembapan']) }}
                                                </span>
                                            @endif

                                            @if(isset($item->input_data['cahaya']))
                                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                                    Cahaya: {{ ucfirst($item->input_data['cahaya']) }}
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if(isset($item->results) && !empty($item->results))
                                            <div class="space-y-2">
                                                @php
                                                    $resultsArray = is_string($item->results) ? json_decode($item->results, true) : $item->results;
                                                    $resultsArray = is_array($resultsArray) ? $resultsArray : [];
                                                    $displayResults = array_slice($resultsArray, 0, 2);
                                                @endphp

                                                @foreach($displayResults as $result)
                                                    <div class="flex items-center">
                                                        <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                                                        <span class="text-gray-800">
                                                            @if(is_array($result) && isset($result['tanaman']['nama']))
                                                                {{ $result['tanaman']['nama'] }}
                                                            @elseif(is_array($result) && isset($result['nama']))
                                                                {{ $result['nama'] }}
                                                            @elseif(is_object($result) && isset($result->tanaman->nama))
                                                                {{ $result->tanaman->nama }}
                                                            @elseif(is_object($result) && isset($result->nama))
                                                                {{ $result->nama }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </span>
                                                        @if(isset($result['confidence']) || isset($result->confidence))
                                                            <span class="ml-2 text-xs text-gray-500">
                                                                ({{ round((isset($result['confidence']) ? $result['confidence'] : $result->confidence) * 100) }}%)
                                                            </span>
                                                        @endif
                                                    </div>
                                                @endforeach

                                                @if(count($resultsArray) > 2)
                                                    <div class="text-sm text-gray-500">
                                                        + {{ count($resultsArray) - 2 }} more
                                                    </div>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-gray-500">Tidak ada hasil</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <button
                                            class="text-blue-600 hover:text-blue-800 mr-3 view-details"
                                            data-history="{{ json_encode($item) }}"
                                        >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('rekomendasi', [
                                            'suhu' => $item->input_data['suhu'] ?? '',
                                            'kelembapan' => $item->input_data['kelembapan'] ?? '',
                                            'cahaya' => $item->input_data['cahaya'] ?? ''
                                        ]) }}" class="text-green-600 hover:text-green-800">
                                            <i class="fas fa-redo"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="px-6 py-4 border-t">
                    {{ $history->links() }}
                </div>
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-8 text-center">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 text-4xl mx-auto mb-4">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Riwayat</h3>
                <p class="text-gray-600 mb-6">Anda belum pernah menggunakan fitur rekomendasi tanaman.</p>
                <a href="{{ route('rekomendasi') }}" class="px-6 py-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors inline-block">
                    Coba Rekomendasi Sekarang
                </a>
            </div>
        @endif
    </div>
</div>
<div class="pt-10"></div>

{{-- Detail Modal --}}
<div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full mx-4 max-h-[90vh] overflow-y-auto">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-800">Detail Rekomendasi</h3>
            <button id="closeModal" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="p-6">
            <div class="mb-6">
                <h4 class="text-lg font-medium text-gray-700 mb-2">Parameter Input</h4>
                <div id="modalParameters" class="flex flex-wrap gap-2"></div>
            </div>

            <div>
                <h4 class="text-lg font-medium text-gray-700 mb-2">Hasil Rekomendasi</h4>
                <div id="modalResults" class="space-y-4"></div>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 bg-gray-50 flex justify-end">
            <button id="closeModalBtn" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('detailModal');
        const closeModal = document.getElementById('closeModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const modalParameters = document.getElementById('modalParameters');
        const modalResults = document.getElementById('modalResults');

        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const historyData = JSON.parse(this.getAttribute('data-history'));

                modalParameters.innerHTML = '';
                modalResults.innerHTML = '';

                // Display parameters...

                // Process results with better error handling
                let results = historyData.results;

                if (typeof results === 'string') {
                    try {
                        results = JSON.parse(results);
                    } catch (e) {
                        console.error('Failed to parse results JSON:', e);
                        results = [];
                    }
                }

                if (results && Array.isArray(results) && results.length > 0) {
                    results.forEach((result, index) => {
                        const tanaman = result.tanaman || result;
                        const nama = tanaman.nama || 'N/A';
                        const confidence = Math.round((result.confidence || 0) * 100);

                        let confidenceClass = 'text-red-600';
                        let confidenceBgClass = 'bg-red-600';

                        if (confidence > 70) {
                            confidenceClass = 'text-green-600';
                            confidenceBgClass = 'bg-green-600';
                        } else if (confidence > 40) {
                            confidenceClass = 'text-yellow-600';
                            confidenceBgClass = 'bg-yellow-600';
                        }

                        modalResults.innerHTML += `
                            <div class="p-4 border rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-green-100 rounded-lg p-2 mr-3">
                                        <span class="text-xl font-bold text-green-800">${index + 1}</span>
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-medium text-gray-800 text-lg">${result.tanaman?.nama || 'N/A'}</h4>
                                        <div class="flex items-center mt-1">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="h-2.5 rounded-full ${confidenceBgClass}" style="width: ${confidence}%"></div>
                                            </div>
                                            <span class="ml-2 font-medium ${confidenceClass}">${confidence}%</span>
                                        </div>
                                        <div class="mt-2 flex flex-wrap gap-1">
                                            ${result.tanaman?.parameter_suhu ? `
                                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                                    ${capitalizeFirstLetter(result.tanaman.parameter_suhu)}
                                                </span>
                                            ` : ''}

                                            ${result.tanaman?.parameter_kelembapan ? `
                                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">
                                                    ${capitalizeFirstLetter(result.tanaman.parameter_kelembapan)}
                                                </span>
                                            ` : ''}

                                            ${result.tanaman?.parameter_cahaya ? `
                                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                                    ${capitalizeFirstLetter(result.tanaman.parameter_cahaya)}
                                                </span>
                                            ` : ''}
                                        </div>
                                        ${result.tanaman?.id ? `
                                            <a href="/tanaman/${result.tanaman.id}" class="mt-2 inline-block text-green-600 hover:text-green-800 text-sm">
                                                Lihat detail tanaman <i class="fas fa-arrow-right ml-1"></i>
                                            </a>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    modalResults.innerHTML = `
                        <div class="p-4 bg-yellow-50 text-yellow-800 rounded-lg" role="alert">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                <p class="m-0">Tidak ditemukan tanaman yang cocok dengan parameter tersebut.</p>
                            </div>
                        </div>
                    `;
                }

                // Show the modal
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
        });

        closeModal.addEventListener('click', function() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        closeModalBtn.addEventListener('click', function() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }
        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    });
</script>
@endpush
