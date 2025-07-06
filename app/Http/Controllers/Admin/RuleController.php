<?php

// app/Http/Controllers/Admin/RuleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FuzzyRule;
use App\Models\Parameter;
use App\Models\Tanaman;
use App\Services\FuzzyMamdaniService;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    protected $fuzzyService;

    public function __construct(FuzzyMamdaniService $fuzzyService)
    {
        $this->fuzzyService = $fuzzyService;
    }

    public function index()
    {
        $rules = FuzzyRule::with(['suhu', 'kelembapan', 'cahaya', 'tanaman'])->orderBy('id')->paginate(10);
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        // Get parameter options from database
        $parameters = Parameter::all()->groupBy('type');

        $opsi = [
            'suhu' => $parameters->get('suhu', collect())->pluck('label', 'id'),
            'kelembapan' => $parameters->get('kelembapan', collect())->pluck('label', 'id'),
            'cahaya' => $parameters->get('cahaya', collect())->pluck('label', 'id'),
        ];

        return view('admin.rules.create', compact('opsi'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'suhu' => 'required|exists:parameter,id',
            'kelembapan' => 'required|exists:parameter,id',
            'cahaya' => 'required|exists:parameter,id',
            'tanaman_id' => 'required|exists:tanamans,id',
        ]);

        // Get the tanaman name to use as rekomendasi
        $tanaman = Tanaman::findOrFail($req->tanaman_id);

        FuzzyRule::create([
            'parameter_suhu_id' => $req->suhu,
            'parameter_kelembapan_id' => $req->kelembapan,
            'parameter_cahaya_id' => $req->cahaya,
            'tanaman_id' => $req->tanaman_id,
            'rekomendasi' => $tanaman->nama,
        ]);

        return redirect()->route('admin.rules.index')
                         ->with('success', 'Rule berhasil disimpan.');
    }

    public function edit($id)
    {
        $rule = FuzzyRule::findOrFail($id);

        // Get parameter options from database
        $parameters = Parameter::all()->groupBy('type');

        $opsi = [
            'suhu' => $parameters->get('suhu', collect())->pluck('label', 'id'),
            'kelembapan' => $parameters->get('kelembapan', collect())->pluck('label', 'id'),
            'cahaya' => $parameters->get('cahaya', collect())->pluck('label', 'id'),
        ];

        // Get all tanaman for dropdown
        $tanaman = Tanaman::orderBy('nama')->pluck('nama', 'id');

        return view('admin.rules.edit', compact('rule', 'opsi', 'tanaman'));
    }

    public function update(Request $req, $id)
    {
        $req->validate([
            'suhu' => 'required|exists:parameter,id',
            'kelembapan' => 'required|exists:parameter,id',
            'cahaya' => 'required|exists:parameter,id',
            'tanaman_id' => 'required|exists:tanamans,id',
        ]);

        // Get the tanaman name to use as rekomendasi
        $tanaman = Tanaman::findOrFail($req->tanaman_id);

        $rule = FuzzyRule::findOrFail($id);
        $rule->update([
            'parameter_suhu_id' => $req->suhu,
            'parameter_kelembapan_id' => $req->kelembapan,
            'parameter_cahaya_id' => $req->cahaya,
            'tanaman_id' => $req->tanaman_id,
            'rekomendasi' => $tanaman->nama,
        ]);

        return redirect()->route('admin.rules.index')
                         ->with('success', 'Rule berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rule = FuzzyRule::findOrFail($id);
        $rule->delete();

        return redirect()->route('admin.rules.index')
                         ->with('success', 'Rule berhasil dihapus.');
    }

    /**
     * Get suggested tanaman based on selected parameters using Fuzzy Mamdani
     */
    public function getSuggestedTanaman(Request $request)
    {
        $suhuId = (int)$request->input('suhu');
        $kelembapanId = (int)$request->input('kelembapan');
        $cahayaId = (int)$request->input('cahaya');

        // Use the fuzzy service to find matching tanaman
        $tanaman = $this->fuzzyService->findMatchingTanaman($suhuId, $kelembapanId, $cahayaId);

        return response()->json([
            'success' => true,
            'data' => $tanaman,
        ]);
    }

    /**
     * Get recommendations based on actual sensor values
     */
    public function getRecommendations(Request $request)
    {
        $request->validate([
            'suhu' => 'required|numeric',
            'kelembapan' => 'required|numeric',
            'cahaya' => 'required|numeric',
        ]);

        $suhu = $request->input('suhu');
        $kelembapan = $request->input('kelembapan');
        $cahaya = $request->input('cahaya');

        // Use the fuzzy service to get recommendations
        $recommendations = $this->fuzzyService->getRecommendations($suhu, $kelembapan, $cahaya);

        return response()->json([
            'success' => true,
            'data' => $recommendations
        ]);
    }

    /**
     * Get all tanaman for rule creation
     */
    public function getAllTanaman()
    {
        $tanaman = Tanaman::select('id', 'nama')->orderBy('nama')->get();

        return response()->json([
            'success' => true,
            'data' => $tanaman,
        ]);
    }
}
