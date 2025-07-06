<?php

namespace App\Http\Controllers;

use App\Models\FuzzyRule;
use App\Models\Parameter;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\RecommendationResult;

class RecommendationController extends Controller
{
    /**
     * Tampilkan form rekomendasi.
     */
    public function index()
    {
        return view('users.rekomendasi');
    }

    /**
     * Proses input user, cari rule di fuzzy_rules,
     * lalu kembalikan daftar tanaman.
     */
    public function process(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'suhu'       => 'required|string|in:dingin,sedang,panas',
            'kelembapan' => 'required|string|in:kering,lembab,basah',
            'cahaya'     => 'required|string|in:redup,sedang,terang',
        ]);

        // 2. Ambil object Parameter berdasarkan label dan jenis
        $suhuParam = Parameter::where('type', 'suhu')
                        ->where('label', $request->suhu)
                        ->first();
        $kelembapanParam = Parameter::where('type', 'kelembapan')
                        ->where('label', $request->kelembapan)
                        ->first();
        $cahayaParam = Parameter::where('type', 'cahaya')
                        ->where('label', $request->cahaya)
                        ->first();

        if (! $suhuParam || ! $kelembapanParam || ! $cahayaParam) {
            return response()->json([
                'success'         => false,
                'message'         => 'Salah satu parameter tidak ditemukan',
                'recommendations' => [],
            ]);
        }

        $recommendations = [];

        // 3. Exact match: cari satu aturan yang tepat
        $exactRule = FuzzyRule::with(['tanaman', 'parameterSuhu','parameterKelembapan','parameterCahaya'])
            ->where('parameter_suhu_id', $suhuParam->id)
            ->where('parameter_kelembapan_id', $kelembapanParam->id)
            ->where('parameter_cahaya_id', $cahayaParam->id)
            ->first();

            if ($exactRule && $exactRule->tanaman) {
                $recommendations[] = [
                    'tanaman'    => [
                        'id'     => $exactRule->tanaman->id,
                        'nama'   => $exactRule->tanaman->nama,
                        'gambar' => $exactRule->tanaman->gambar,
                    ],
                    'confidence' => 1.0,
                    'rule'       => [
                        'suhu'       => $exactRule->parameterSuhu->label,
                        'kelembapan' => $exactRule->parameterKelembapan->label,
                        'cahaya'     => $exactRule->parameterCahaya->label,
                    ],
                ];
            }


        // 4. Fuzzy match: hitung skor untuk setiap rule di tabel fuzzy_rules
        if (empty($recommendations)) {
            $allRules = FuzzyRule::with(['tanaman','parameterSuhu','parameterKelembapan','parameterCahaya'])
                         ->get();

            $matches = $allRules->map(function ($rule) use ($suhuParam, $kelembapanParam, $cahayaParam) {
                $score = 0;
                $score += ($rule->parameter_suhu_id       == $suhuParam->id)       ? 1 : 0;
                $score += ($rule->parameter_kelembapan_id == $kelembapanParam->id) ? 1 : 0;
                $score += ($rule->parameter_cahaya_id     == $cahayaParam->id)     ? 1 : 0;
                $confidence = $score / 3;

                return [
                    'tanaman'    => [
                        'id'     => $rule->tanaman->id,
                        'nama'   => $rule->tanaman->nama,
                        'gambar' => $rule->tanaman->gambar,
                    ],
                    'confidence' => $confidence,
                    'rule'       => [
                        'suhu'       => $rule->parameterSuhu->label,
                        'kelembapan' => $rule->parameterKelembapan->label,
                        'cahaya'     => $rule->parameterCahaya->label,
                    ],
                ];
            })
            ->filter(fn($item) => $item['confidence'] > 0)
            ->sortByDesc('confidence')
            ->values()
            ->all();

            // Ambil maksimal 5 hasil teratas
            $recommendations = array_slice($matches, 0, 5);
        }

        if (Auth::check()) {
            try {
                // Buat structure nested mirip response JSON
                // $nestedRecs = array_map(function($rec) {
                //     return [
                //         'tanaman'    => [
                //             'id'     => $rec['tanaman']->id,
                //             'nama'   => $rec['tanaman']->nama,
                //             'gambar' => $rec['tanaman']->gambar,
                //         ],
                //         'rule' => [
                //             'suhu'       => $rec['rule']->parameterSuhu->label,
                //             'kelembapan' => $rec['rule']->parameterKelembapan->label,
                //             'cahaya'     => $rec['rule']->parameterCahaya->label,
                //         ],
                //         'confidence' => $rec['confidence'],
                //         'exact'      => $rec['exact'] ?? false,
                //     ];
                // }, $recommendations);

                \App\Models\RecommendationResult::create([
                    'user_id'    => Auth::id(),
                    'input_data' => json_encode($request->only(['suhu','kelembapan','cahaya'])),
                    'results'    => json_encode($recommendations),
                ]);
            } catch (\Throwable $e) {
                Log::error("Gagal simpan riwayat rekomendasi: {$e->getMessage()}");
            }
        }


        // 6. Kirim respons JSON
        return response()->json([
            'success'         => true,
            'input'           => $request->only(['suhu','kelembapan','cahaya']),
            'recommendations' => $recommendations,
        ]);
    }

    /**
     * Tampilkan halaman history rekomendasi user.
     */
    public function history()
    {
        $history = RecommendationResult::where('user_id', Auth::id())
    ->orderBy('created_at', 'desc')
    ->paginate(10);


        // Decode JSON results jika perlu
        $history->getCollection()->transform(function ($item) {
            if (is_string($item->results)) {
                $item->results = json_decode($item->results, true) ?: [];
            }
            return $item;
        });

        return view('users.recommendation-history', compact('history'));
    }
}
