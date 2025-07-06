<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Rule Fuzzy
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <form action="{{ route('admin.rules.update', $rule) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @foreach(['suhu', 'kelembapan', 'cahaya'] as $field)
                            <div class="mb-4">
                                <x-input-label :for="$field" :value="ucfirst($field)" />

                                <select name="{{ $field }}" id="{{ $field }}"
                                        class="block mt-1 w-full border-gray-300 rounded">
                                    <option value="">-- Pilih {{ ucfirst($field) }} --</option>
                                    @foreach($opsi[$field] as $id => $label)
                                        <option value="{{ $id }}" 
                                            {{ old($field, $rule->{"parameter_{$field}_id"}) == $id ? 'selected' : '' }}>
                                            {{ ucfirst($label) }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-input-error :messages="$errors->get($field)" class="mt-2" />
                            </div>
                        @endforeach

                        <div class="mb-4">
                            <x-input-label for="tanaman_id" value="Rekomendasi Tanaman" />
                            <select name="tanaman_id" id="tanaman_id"
                                    class="block mt-1 w-full border-gray-300 rounded">
                                <option value="">-- Pilih Tanaman --</option>
                                @foreach($tanaman as $id => $nama)
                                    <option value="{{ $id }}" 
                                        {{ old('tanaman_id', $rule->tanaman_id) == $id ? 'selected' : '' }}>
                                        {{ $nama }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('tanaman_id')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-secondary-button onclick="window.history.back()" class="mr-2">
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