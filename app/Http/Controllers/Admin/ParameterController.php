<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Illuminate\Http\Request;

class ParameterController extends Controller
{
    // Define the categories for each parameter type
    private $typeCategories = [
        'suhu' => ['dingin', 'sedang', 'panas'],
        'kelembapan' => ['kering', 'lembab', 'basah'],
        'cahaya' => ['redup', 'sedang', 'terang']
    ];

    public function index()
    {
        $types = Parameter::select('type')->distinct()->get();

        $groupedParameters = $types->map(function ($item) {
            return [
                'type' => $item->type,
                'data' => Parameter::where('type', $item->type)
                ->orderByRaw(
                    "FIELD(label, "
                    . collect($this->typeCategories[$item->type])
                        ->map(fn($l) => "'{$l}'")
                        ->implode(',')
                    . ")"
                )
                ->get()
            ];
        });

        return view('admin.parameter.index', compact('groupedParameters'));
    }

    public function create()
    {
        return view('admin.parameter.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:suhu,kelembapan,cahaya',
            'label' => 'required|array|min:1',
            'label.*' => 'required|string',
            'min' => 'required|array|min:1',
            'min.*' => 'required|numeric',
            'max' => 'required|array|min:1',
            'max.*' => 'required|numeric|gt:min.*',
        ]);

        // Check if the labels match the expected categories for the selected type
        $validLabels = $this->typeCategories[$request->type] ?? [];
        foreach ($request->label as $label) {
            if (!in_array($label, $validLabels)) {
                return redirect()->back()->withErrors(['label' => 'Invalid category for the selected parameter type.']);
            }
        }

        foreach ($request->label as $i => $label) {
            Parameter::create([
                'type' => $request->type,
                'label' => $label,
                'min' => $request->min[$i],
                'max' => $request->max[$i],
            ]);
        }

        return redirect()->route('admin.parameter.index')
                        ->with('success', 'Semua parameter berhasil ditambahkan.');
    }

    public function editByType($type)
    {
        $parameters = Parameter::where('type', $type)
        ->orderByRaw(
            "FIELD(label, "
            . collect($this->typeCategories[$type])
                ->map(fn($l) => "'{$l}'")
                ->implode(',')
            . ")"
            )
        ->get();

        return view('admin.parameter.update', compact('type', 'parameters'));
    }

    public function updateByType(Request $request, $type)
    {
        $request->validate([
            'ids'   => 'required|array',
            'mins'  => 'required|array',
            'maxs'  => 'required|array',
        ]);

        foreach ($request->ids as $i => $id) {
            Parameter::where('id', $id)->update([
                'min' => $request->mins[$i],
                'max' => $request->maxs[$i],
            ]);
        }

        return redirect()->route('admin.parameter.index')
                        ->with('success', 'Parameter berhasil diperbarui.');
    }

    public function deleteByType($type)
    {
        Parameter::where('type', $type)->delete();
        return redirect()->route('admin.parameter.index')
                        ->with('success', 'Semua parameter tipe ' . $type . ' berhasil dihapus.');
    }
}
