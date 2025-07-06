<x-app-layout>
  <x-slot name="header"><h2>Daftar Parameter</h2></x-slot>
  <div class="py-6">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <x-primary-link href="{{ route('admin.parameter.create') }}">Tambah Parameter</x-primary-link>
      <div class="mt-4 bg-white shadow rounded">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
    <thead class="bg-gray-100">
        <tr>
            <th class="border border-gray-300 px-4 py-2">Type</th>
            <th class="border border-gray-300 px-4 py-2">Label</th>
            <th class="border border-gray-300 px-4 py-2">Min</th>
            <th class="border border-gray-300 px-4 py-2">Max</th>
            <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groupedParameters as $group)
            @foreach ($group['data'] as $index => $param)
                <tr>
                    @if ($index === 0)
                        <td class="border border-gray-300 px-4 py-2" rowspan="{{ count($group['data']) }}">
                            {{ ucfirst($group['type']) }}
                        </td>
                    @endif
                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($param->label) }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $param->min }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $param->max }}</td>
                    @if ($index === 0)
                        <td class="border border-gray-300 px-4 py-2" rowspan="{{ count($group['data']) }}">
                            <a href="{{ route('admin.parameter.editByType', $group['type']) }}" class="text-blue-600">Edit</a>
                            <form method="POST" action="{{ route('admin.parameter.deleteByType', $group['type']) }}" onsubmit="return confirm('Yakin ingin menghapus semua parameter tipe ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 mt-2">Hapus</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
      </div>
    </div>
  </div>
</x-app-layout>
