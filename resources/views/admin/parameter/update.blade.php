<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Parameter: {{ ucfirst($type) }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto">
        <form action="{{ route('admin.parameter.updateByType', $type) }}" method="POST" class="bg-white shadow rounded p-6">
            @csrf
            @method('PUT')

            <table class="table-auto w-full border border-gray-300 mb-4">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2">Label</th>
                        <th class="border p-2">Min</th>
                        <th class="border p-2">Max</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parameters as $i => $param)
                        <input type="hidden" name="ids[]" value="{{ $param->id }}">
                        <tr>
                            <td class="border p-2">
                                <input type="text" name="labels[]" value="{{ $param->label }}" readonly class="w-full p-1 bg-gray-100 rounded border">
                            </td>
                            <td class="border p-2">
                                <input type="number" name="mins[]" value="{{ $param->min }}" class="w-full p-1 border rounded" required>
                            </td>
                            <td class="border p-2">
                                <input type="number" name="maxs[]" value="{{ $param->max }}" class="w-full p-1 border rounded" required>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <x-primary-button type="submit">Perbarui</x-primary-button>
        </form>
    </div>
</x-app-layout>
