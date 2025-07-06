<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Tambah Parameter Sekaligus</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('admin.parameter.store') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="type" value="Tipe Parameter" />
                    <select name="type" id="type" required
                        class="w-full border-gray-300 rounded shadow-sm" onchange="updateCategories()">
                        <option value="">-- Pilih Tipe --</option>
                        <option value="suhu">Suhu</option>
                        <option value="kelembapan">Kelembapan</option>
                        <option value="cahaya">Cahaya</option>
                    </select>
                </div>

                <div id="categories-container" class="hidden">
                </div>

                <div class="mt-6">
                    <x-primary-button class="w-full justify-center">Simpan Semua</x-primary-button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateCategories() {
            const type = document.getElementById('type').value;
            const container = document.getElementById('categories-container');

            if (!type) {
                container.classList.add('hidden');
                container.innerHTML = '';
                return;
            }

            let categories = [];

            switch(type) {
                case 'suhu':
                    categories = ['dingin', 'sedang', 'panas'];
                    break;
                case 'kelembapan':
                    categories = ['kering', 'lembab', 'basah'];
                    break;
                case 'cahaya':
                    categories = ['redup', 'sedang', 'terang'];
                    break;
                default:
                    categories = [];
            }

            let html = '';

            categories.forEach(category => {
                html += `
                    <div class="mb-4 border p-4 rounded bg-gray-50">
                        <h3 class="font-bold text-lg mb-2">Kategori: ${category.charAt(0).toUpperCase() + category.slice(1)}</h3>
                        <input type="hidden" name="label[]" value="${category}">

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label :value="'Min'" />
                                <input type="number" name="min[]" required class="w-full border-gray-300 rounded shadow-sm">
                            </div>
                            <div>
                                <x-input-label :value="'Max'" />
                                <input type="number" name="max[]" required class="w-full border-gray-300 rounded shadow-sm">
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
            container.classList.remove('hidden');
        }
    </script>
</x-app-layout>
