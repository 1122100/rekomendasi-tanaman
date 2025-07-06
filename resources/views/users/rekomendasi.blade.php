@extends('layouts.appuser')

@section('content')
<div class="pt-10">
<div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-2xl shadow-xl">
    <h2 class="text-2xl font-bold text-green-700 mb-2">Rekomendasi Tanaman</h2>
    <p class="text-gray-600 mb-6">Dapatkan rekomendasi tanaman yang cocok berdasarkan kondisi lingkungan Anda menggunakan metode Fuzzy Mamdani</p>

    <div class="bg-green-50 p-4 rounded-lg mb-6">
        <h3 class="text-lg font-medium text-green-800 mb-2">Cara Kerja Sistem Rekomendasi</h3>
        <p class="text-green-700">
            Sistem ini menggunakan metode Fuzzy Mamdani dengan aturan "IF-THEN" untuk menentukan tanaman yang paling cocok berdasarkan parameter lingkungan.
            Pilih kondisi suhu, kelembapan, dan intensitas cahaya untuk mendapatkan rekomendasi tanaman yang sesuai.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <div>
            <form id="rekomendasiForm" class="space-y-4 bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="font-semibold text-gray-800 mb-2">Pilih Kondisi Lingkungan</h3>

                <div>
                    <label for="suhu" class="block font-medium text-gray-700">Suhu</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <select id="suhu" name="suhu" required
                            class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-green-400 focus:ring-green-300">
                            <option value="">-- Pilih Kondisi Suhu --</option>
                            <option value="dingin">Dingin</option>
                            <option value="sedang">Sedang</option>
                            <option value="panas">Panas</option>
                        </select>
                        <div class="text-xs text-gray-500 mt-1">
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-1">Dingin: &lt;18°C</span>
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full mr-1">Sedang: 18-27°C</span>
                            <span class="inline-block px-2 py-1 bg-red-100 text-red-800 rounded-full">Panas: &gt;27-32°C</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="kelembapan" class="block font-medium text-gray-700">Kelembapan</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <select id="kelembapan" name="kelembapan" required
                            class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-green-400 focus:ring-green-300">
                            <option value="">-- Pilih Kondisi Kelembapan --</option>
                            <option value="kering">Kering</option>
                            <option value="lembab">Lembab</option>
                            <option value="basah">Basah</option>
                        </select>
                        <div class="text-xs text-gray-500 mt-1">
                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full mr-1">Kering: &lt;40%</span>
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 rounded-full mr-1">Lembab: 40-70%</span>
                            <span class="inline-block px-2 py-1 bg-blue-300 text-blue-800 rounded-full">Basah: &gt;70-100%</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="cahaya" class="block font-medium text-gray-700">Intensitas Cahaya</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <select id="cahaya" name="cahaya" required
                            class="mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-green-400 focus:ring-green-300">
                            <option value="">-- Pilih Kondisi Cahaya --</option>
                            <option value="redup">Redup</option>
                            <option value="sedang">Sedang</option>
                            <option value="terang">Terang</option>
                        </select>
                        <div class="text-xs text-gray-500 mt-1">
                            <span class="inline-block px-2 py-1 bg-gray-100 text-gray-800 rounded-full mr-1">Redup: &lt;500 lux</span>
                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full mr-1">Sedang: 500-1000 lux</span>
                            <span class="inline-block px-2 py-1 bg-yellow-300 text-yellow-800 rounded-full">Terang: &gt;1000-2000 lux</span>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-300 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Cari Rekomendasi
                </button>
            </form>
        </div>

        <div id="hasilRekomendasi" class="hidden bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
            <h3 class="text-xl font-semibold mb-4 text-green-700 border-b pb-2">Hasil Rekomendasi Tanaman</h3>

            <div id="inputSummary" class="mb-4 p-3 bg-gray-50 rounded-lg text-sm">
                <h4 class="font-medium text-gray-700 mb-2">Parameter Input:</h4>
                <div class="grid grid-cols-3 gap-2">
                    <div class="text-center p-2 rounded-lg bg-blue-50">
                        <div class="text-blue-800 font-medium">Suhu</div>
                        <div id="summaryTemp" class="mt-1 text-lg font-semibold">-</div>
                    </div>
                    <div class="text-center p-2 rounded-lg bg-blue-50">
                        <div class="text-blue-800 font-medium">Kelembapan</div>
                        <div id="summaryHumidity" class="mt-1 text-lg font-semibold">-</div>
                    </div>
                    <div class="text-center p-2 rounded-lg bg-blue-50">
                        <div class="text-blue-800 font-medium">Cahaya</div>
                        <div id="summaryLight" class="mt-1 text-lg font-semibold">-</div>
                    </div>
                </div>
            </div>

            <div id="fuzzyRuleDisplay" class="mb-4 p-3 bg-green-50 rounded-lg text-sm">
                <h4 class="font-medium text-green-800 mb-2">Aturan Fuzzy yang Digunakan:</h4>
                <div id="ruleText" class="p-2 bg-white rounded border border-green-200 font-mono text-sm">
                    IF (Suhu = <span id="ruleTemp" class="font-semibold text-blue-600">-</span>) AND
                    (Kelembapan = <span id="ruleHumidity" class="font-semibold text-blue-600">-</span>) AND
                    (Cahaya = <span id="ruleLight" class="font-semibold text-blue-600">-</span>)
                    THEN (Tanaman = <span id="ruleTanaman" class="font-semibold text-green-600">-</span>)
                </div>
            </div>

            <div id="rekomendasiContainer">
                <h4 class="font-medium text-gray-700 mb-2">Tanaman yang Direkomendasikan:</h4>
                <div id="loadingIndicator" class="py-4 text-center hidden">
                    <svg class="animate-spin h-8 w-8 text-green-500 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-2 text-gray-600">Mencari rekomendasi...</p>
                </div>
                <div id="rekomendasiList" class="space-y-3"></div>
            </div>
        </div>
    </div>
</div>
<div class="pt-20 -mt-2">
</div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const rekomendasiForm = document.getElementById('rekomendasiForm');
        const hasilRekomendasi = document.getElementById('hasilRekomendasi');
        const rekomendasiList = document.getElementById('rekomendasiList');
        const loadingIndicator = document.getElementById('loadingIndicator');

        // Summary elements
        const summaryTemp = document.getElementById('summaryTemp');
        const summaryHumidity = document.getElementById('summaryHumidity');
        const summaryLight = document.getElementById('summaryLight');

        // Rule elements
        const ruleTemp = document.getElementById('ruleTemp');
        const ruleHumidity = document.getElementById('ruleHumidity');
        const ruleLight = document.getElementById('ruleLight');
        const ruleTanaman = document.getElementById('ruleTanaman');

        rekomendasiForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const suhu = document.getElementById('suhu').value;
            const kelembapan = document.getElementById('kelembapan').value;
            const cahaya = document.getElementById('cahaya').value;

            // Validate all fields are selected
            if (!suhu || !kelembapan || !cahaya) {
                alert('Silakan pilih semua parameter kondisi lingkungan');
                return;
            }

            // Update summary
            summaryTemp.textContent = capitalizeFirstLetter(suhu);
            summaryHumidity.textContent = capitalizeFirstLetter(kelembapan);
            summaryLight.textContent = capitalizeFirstLetter(cahaya);

            // Update rule display
            ruleTemp.textContent = suhu;
            ruleHumidity.textContent = kelembapan;
            ruleLight.textContent = cahaya;
            ruleTanaman.textContent = "?";

            // Show loading and results container
            hasilRekomendasi.classList.remove('hidden');
            loadingIndicator.classList.remove('hidden');
            rekomendasiList.innerHTML = '';

            // Make API request
            fetch(`{{ route('rekomendasi.process') }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    suhu: suhu,
                    kelembapan: kelembapan,
                    cahaya: cahaya
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                loadingIndicator.classList.add('hidden');

                if (data.recommendations && data.recommendations.length > 0) {
                    // Update rule with the best match
                    if (data.recommendations[0].rule) {
                        ruleTanaman.textContent = data.recommendations[0].tanaman.nama;
                    }

                    // Create result cards
                    const resultContainer = document.createElement('div');
                    resultContainer.className = 'grid grid-cols-1 gap-4';

                    data.recommendations.forEach((item, index) => {
                        const confidence = Math.round(item.confidence * 100);
                        const card = document.createElement('div');
                        card.className = 'p-4 border rounded-lg hover:bg-green-50 transition-colors';

                        let confidenceClass = 'text-red-600';
                        if (confidence > 70) {
                            confidenceClass = 'text-green-600';
                        } else if (confidence > 40) {
                            confidenceClass = 'text-yellow-600';
                        }

                        // Get parameter labels from the rule's relationships
                        const suhuLabel       = item.rule?.suhu       || '-';
const kelembapanLabel = item.rule?.kelembapan || '-';
const cahayaLabel     = item.rule?.cahaya     || '-';

                        card.innerHTML = `
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-green-100 rounded-lg p-2 mr-3">
                                    <span class="text-xl font-bold text-green-800">${index + 1}</span>
                                </div>
                                <div class="flex-grow">
                                    <h4 class="font-medium text-green-800 text-lg">${item.tanaman.nama}</h4>
                                    <div class="flex items-center mt-1">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="h-2.5 rounded-full ${confidenceClass.replace('text', 'bg')}" style="width: ${confidence}%"></div>
                                        </div>
                                        <span class="ml-2 font-medium ${confidenceClass}">${confidence}%</span>
                                    </div>
                                    <div class="mt-2 flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            ${capitalizeFirstLetter(suhuLabel)}
                                        </span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            ${capitalizeFirstLetter(kelembapanLabel)}
                                        </span>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">
                                            ${capitalizeFirstLetter(cahayaLabel)}
                                        </span>
                                    </div>
                                    <a href="/tanaman/${item.tanaman.id}" class="mt-2 inline-block text-green-600 hover:text-green-800 text-sm">
                                        Lihat detail tanaman <i class="fas fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        `;

                        resultContainer.appendChild(card);
                    });

                    rekomendasiList.appendChild(resultContainer);
                } else {
                    rekomendasiList.innerHTML = `
                        <div class="p-4 bg-yellow-50 text-yellow-800 rounded-lg">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <span>Tidak ditemukan tanaman yang cocok dengan parameter tersebut.</span>
                            </div>
                            <p class="mt-2 text-sm">Coba kombinasi parameter lain atau hubungi admin untuk menambahkan data tanaman baru.</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                loadingIndicator.classList.add('hidden');
                rekomendasiList.innerHTML = `
                    <div class="p-4 bg-red-50 text-red-800 rounded-lg">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Terjadi kesalahan saat mengambil data. Silakan coba lagi.</span>
                        </div>
                        <p class="mt-2 text-sm">Detail: ${error.message}</p>
                    </div>
                `;
            });
        });

        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    });
</script>
@endsection
