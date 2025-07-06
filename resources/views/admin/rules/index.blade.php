<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Rule Fuzzy
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <x-primary-link href="{{ route('admin.rules.create') }}">
                    Tambah Rule Baru
                </x-primary-link>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Suhu
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kelembapan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Cahaya
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Rekomendasi Tanaman
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($rules as $rule)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ ucfirst($rule->suhu->label ?? '-') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ ucfirst($rule->kelembapan->label ?? '-') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ ucfirst($rule->cahaya->label ?? '-') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $rule->tanaman->nama ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <a href="{{ route('admin.rules.edit', $rule) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                            Edit
                                        </a>
                                        <form class="inline-block" action="{{ route('admin.rules.destroy', $rule) }}" method="POST" 
                                            onsubmit="return confirm('Yakin ingin menghapus rule ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                        Belum ada data rule
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $rules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>