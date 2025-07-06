<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Rule Fuzzy Mamdani
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4 p-4 bg-blue-50 rounded-md">
                        <h3 class="text-blue-800 font-medium mb-2">Informasi Metode Fuzzy Mamdani</h3>
                        <p class="text-blue-700">
                            Sistem ini menggunakan metode Fuzzy Mamdani untuk menentukan rekomendasi tanaman berdasarkan parameter yang dipilih.
                            Aturan fuzzy menggunakan format "IF-THEN" untuk mencocokkan kondisi dengan tanaman yang sesuai.
                        </p>
                    </div>

                    <form action="{{ route('admin.rules.store') }}" method="POST" id="ruleForm">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            @foreach(['suhu', 'kelembapan', 'cahaya'] as $field)
                                <div class="mb-4">
                                    <x-input-label :for="$field" :value="ucfirst($field)" />

                                    <select name="{{ $field }}" id="{{ $field }}" class="parameter-select block mt-1 w-full border-gray-300 rounded">
                                        <option value="">-- Pilih {{ ucfirst($field) }} --</option>
                                        @foreach($opsi[$field] as $id => $label)
                                            <option value="{{ $id }}" {{ old($field) == $id ? 'selected' : '' }}>
                                                {{ ucfirst($label) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <x-input-error :messages="$errors->get($field)" class="mt-2" />
                                </div>
                            @endforeach
                        </div>

                        <!-- Hidden tanaman_id field that will be set automatically -->
                        <input type="hidden" name="tanaman_id" id="tanaman_id" value="{{ old('tanaman_id') }}">
                        <x-input-error :messages="$errors->get('tanaman_id')" class="mt-2" />

                        <div id="rule-preview" class="mb-6 p-4 bg-gray-50 rounded-md hidden">
                            <h3 class="font-medium text-gray-700 mb-2">Preview Aturan Fuzzy:</h3>
                            <div id="rule-text" class="p-3 bg-white rounded border border-gray-200 font-mono text-sm">
                                <!-- Rule preview will be shown here -->
                            </div>
                        </div>

                        <div id="matched-tanaman" class="mb-6">
                            <h3 class="font-medium text-gray-700 mb-2">Pilih Tanaman untuk Rule:</h3>
                            <div id="tanaman-list" class="p-4 bg-gray-50 rounded-md">
                                <p class="text-gray-500">Pilih parameter terlebih dahulu.</p>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button id="submitButton" disabled>
                                Simpan Rule
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const parameterSelects = document.querySelectorAll('.parameter-select');
            const tanamanIdInput = document.getElementById('tanaman_id');
            const matchedTanamanDiv = document.getElementById('matched-tanaman');
            const tanamanListDiv = document.getElementById('tanaman-list');
            const submitButton = document.getElementById('submitButton');
            const ruleForm = document.getElementById('ruleForm');
            const rulePreview = document.getElementById('rule-preview');
            const ruleText = document.getElementById('rule-text');

            // Function to update rule preview
            function updateRulePreview() {
                const suhuSelect = document.getElementById('suhu');
                const kelembapanSelect = document.getElementById('kelembapan');
                const cahayaSelect = document.getElementById('cahaya');

                const suhuText = suhuSelect.options[suhuSelect.selectedIndex]?.text || '';
                const kelembapanText = kelembapanSelect.options[kelembapanSelect.selectedIndex]?.text || '';
                const cahayaText = cahayaSelect.options[cahayaSelect.selectedIndex]?.text || '';

                if (suhuText && kelembapanText && cahayaText) {
                    rulePreview.classList.remove('hidden');
                    ruleText.innerHTML = `IF (Suhu = <span class="text-red-600">${suhuText}</span>) AND (Kelembapan = <span class="text-blue-600">${kelembapanText}</span>) AND (Cahaya = <span class="text-green-600">${cahayaText}</span>) THEN (Tanaman = <span class="text-purple-600" id="rule-tanaman-text">?</span>)`;
                } else {
                    rulePreview.classList.add('hidden');
                }
            }

            // Function to get all tanaman for selection
            function getAllTanaman() {
                const suhu = document.getElementById('suhu').value;
                const kelembapan = document.getElementById('kelembapan').value;
                const cahaya = document.getElementById('cahaya').value;

                // Update rule preview
                updateRulePreview();

                // Only proceed if all parameters are selected
                if (!suhu || !kelembapan || !cahaya) {
                    tanamanListDiv.innerHTML = '<p class="text-gray-500">Pilih semua parameter untuk melanjutkan.</p>';
                    submitButton.disabled = true;
                    return;
                }

                // Make AJAX request to get all tanaman
                fetch(`{{ route('admin.rules.tanaman-list') }}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.data.length > 0) {
                        // Clear previous list
                        tanamanListDiv.innerHTML = '';

                        // Create search input
                        const searchContainer = document.createElement('div');
                        searchContainer.className = 'mb-4';

                        const searchInput = document.createElement('input');
                        searchInput.type = 'text';
                        searchInput.placeholder = 'Cari tanaman...';
                        searchInput.className = 'w-full p-2 border border-gray-300 rounded-md';
                        searchInput.addEventListener('input', function() {
                            const searchTerm = this.value.toLowerCase();
                            document.querySelectorAll('.tanaman-item').forEach(item => {
                                const tanamanName = item.querySelector('.tanaman-name').textContent.toLowerCase();
                                if (tanamanName.includes(searchTerm)) {
                                    item.style.display = 'block';
                                } else {
                                    item.style.display = 'none';
                                }
                            });
                        });

                        searchContainer.appendChild(searchInput);
                        tanamanListDiv.appendChild(searchContainer);

                        // Create container for results
                        const resultsContainer = document.createElement('div');
                        resultsContainer.className = 'space-y-2 max-h-96 overflow-y-auto';

                        // Sort tanaman alphabetically
                        data.data.sort((a, b) => a.nama.localeCompare(b.nama));

                        // Display all tanaman as selectable options
                        data.data.forEach((tanaman, index) => {
                            const tanamanItem = document.createElement('div');
                            tanamanItem.className = 'tanaman-item bg-white p-3 rounded-md border border-gray-200 flex items-center';

                            const radioInput = document.createElement('input');
                            radioInput.type = 'radio';
                            radioInput.name = 'tanaman_radio';
                            radioInput.id = `tanaman_radio_${tanaman.id}`;
                            radioInput.value = tanaman.id;
                            radioInput.className = 'mr-3 h-4 w-4 text-green-600';

                            // Set the first tanaman as default selected
                            if (index === 0) {
                                radioInput.checked = true;
                                tanamanIdInput.value = tanaman.id;
                                document.getElementById('rule-tanaman-text').textContent = tanaman.nama;
                            }

                            radioInput.addEventListener('change', function() {
                                // Update hidden input and rule preview
                                tanamanIdInput.value = this.value;
                                document.getElementById('rule-tanaman-text').textContent = tanaman.nama;
                            });

                            const nameLabel = document.createElement('label');
                            nameLabel.htmlFor = `tanaman_radio_${tanaman.id}`;
                            nameLabel.className = 'tanaman-name text-gray-800 flex-grow cursor-pointer';
                            nameLabel.textContent = tanaman.nama;

                            tanamanItem.appendChild(radioInput);
                            tanamanItem.appendChild(nameLabel);

                            resultsContainer.appendChild(tanamanItem);
                        });

                        tanamanListDiv.appendChild(resultsContainer);

                        // Enable submit button
                        submitButton.disabled = false;
                    } else {
                        // No tanaman found
                        tanamanListDiv.innerHTML = '<p class="text-red-500 font-medium">Tidak ada data tanaman. Silakan tambahkan tanaman terlebih dahulu.</p>';
                        tanamanIdInput.value = '';
                        submitButton.disabled = true;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    tanamanListDiv.innerHTML = '<p class="text-red-500">Terjadi kesalahan saat mengambil data tanaman.</p>';
                    submitButton.disabled = true;
                });
            }

            // Helper function to capitalize first letter
            function ucfirst(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }

            // Add event listeners to parameter selects
            parameterSelects.forEach(select => {
                select.addEventListener('change', function() {
                    if (allParametersSelected()) {
                        getAllTanaman();
                    } else {
                        updateRulePreview();
                    }
                });
            });

            // Check if all parameters are selected
            function allParametersSelected() {
                const suhu = document.getElementById('suhu').value;
                const kelembapan = document.getElementById('kelembapan').value;
                const cahaya = document.getElementById('cahaya').value;
                return suhu && kelembapan && cahaya;
            }

            // Validate form before submission
            ruleForm.addEventListener('submit', function(event) {
                if (!tanamanIdInput.value) {
                    event.preventDefault();
                    alert('Silakan pilih tanaman untuk rule ini.');
                }
            });
        });
    </script>
</x-app-layout>
