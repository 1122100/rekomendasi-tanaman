<?php

namespace App\Services;

use App\Models\Parameter;
use App\Models\Tanaman;
use App\Models\FuzzyRule;

class FuzzyMamdaniService
{
    //Fuzzifikasi
    public function calculateMembership($value, $fuzzySet)
    {
        list($min, $peak, $max) = $fuzzySet;

        if ($value <= $min || $value >= $max) {
            return 0;
        } elseif ($value == $peak) {
            return 1;
        } elseif ($value < $peak) {
            return ($value - $min) / ($peak - $min);
        } else {
            return ($max - $value) / ($max - $peak);
        }
    }

    public function fuzzify($inputs)
    {
        $result = [];

        foreach ($inputs as $type => $value) {
            $parameters = Parameter::where('type', $type)->get();
            $result[$type] = [];

            foreach ($parameters as $param) {
                // Get fuzzy set definition from parameter ranges
                // This assumes you have min, mid, max values stored or calculated
                $fuzzySet = $this->getFuzzySetForParameter($param);

                $membership = $this->calculateMembership($value, $fuzzySet);
                $result[$type][$param->id] = $membership;
            }
        }

        return $result;
    }

    private function getFuzzySetForParameter($param)
    {
        // This is a simplified example - you should adapt this to your actual parameter data structure
        switch ($param->label) {
            case 'dingin':
                return [0, 10, 20]; // Example values for cold temperature
            case 'sejuk':
                return [15, 22, 28]; // Example values for cool temperature
            case 'normal':
                return [25, 30, 35]; // Example values for normal temperature
            case 'hangat':
                return [30, 35, 40]; // Example values for warm temperature
            case 'panas':
                return [35, 40, 50]; // Example values for hot temperature
            case 'kering':
                return [0, 20, 40]; // Example values for dry humidity
            case 'lembab':
                return [30, 50, 70]; // Example values for moist humidity
            case 'basah':
                return [60, 80, 100]; // Example values for wet humidity
            case 'gelap':
                return [0, 1000, 3000]; // Example values for low light (lux)
            case 'redup':
                return [2000, 5000, 8000]; // Example values for medium light
            case 'terang':
                return [7000, 10000, 15000]; // Example values for bright light
            default:
                return [0, 50, 100]; // Default range
        }
    }

    public function applyRules($fuzzifiedInputs)
    {
        $rules = FuzzyRule::with(['suhu', 'kelembapan', 'cahaya', 'tanaman'])->get();
        $recommendations = [];

        foreach ($rules as $rule) {
            $suhuMembership = $fuzzifiedInputs['suhu'][$rule->parameter_suhu_id] ?? 0;
            $kelembapanMembership = $fuzzifiedInputs['kelembapan'][$rule->parameter_kelembapan_id] ?? 0;
            $cahayaMembership = $fuzzifiedInputs['cahaya'][$rule->parameter_cahaya_id] ?? 0;

            //Inferensi
            $ruleStrength = min($suhuMembership, $kelembapanMembership, $cahayaMembership);
            if ($ruleStrength > 0) {
                if (!isset($recommendations[$rule->tanaman_id])) {
                    $recommendations[$rule->tanaman_id] = [
                        'tanaman' => $rule->tanaman,
                        'confidence' => $ruleStrength
                    ];
                } else {
                    // If multiple rules recommend the same tanaman, take the maximum confidence
                    $recommendations[$rule->tanaman_id]['confidence'] =
                        max($recommendations[$rule->tanaman_id]['confidence'], $ruleStrength);
                }
            }
        }

        // Sort recommendations by confidence level (descending)
        usort($recommendations, function($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        return $recommendations;
    }

    /**
     * Get tanaman recommendations based on input values
     *
     * @param float $suhu Temperature value
     * @param float $kelembapan Humidity value
     * @param float $cahaya Light value
     * @return array Recommended tanaman with confidence levels
     */
    public function getRecommendations($suhu, $kelembapan, $cahaya)
    {
        $inputs = [
            'suhu' => $suhu,
            'kelembapan' => $kelembapan,
            'cahaya' => $cahaya
        ];

        $fuzzifiedInputs = $this->fuzzify($inputs);
        $recommendations = $this->applyRules($fuzzifiedInputs);

        return $recommendations;
    }

    /**
     * Find matching tanaman based on parameter IDs
     *
     * @param int $suhuId
     * @param int $kelembapanId
     * @param int $cahayaId
     * @return array Matching tanaman
     */
    public function findMatchingTanaman($suhuId, $kelembapanId, $cahayaId)
{
    $allTanaman = Tanaman::all();

    $results = [];

    foreach ($allTanaman as $tanaman) {
        $matchCount = 0;
        $matchedParams = [];

        if ($tanaman->parameter_suhu_id == $suhuId) {
            $matchCount++;
            $matchedParams[] = 'suhu';
        }

        if ($tanaman->parameter_kelembapan_id == $kelembapanId) {
            $matchCount++;
            $matchedParams[] = 'kelembapan';
        }

        if ($tanaman->parameter_cahaya_id == $cahayaId) {
            $matchCount++;
            $matchedParams[] = 'cahaya';
        }

        if ($matchCount > 0) {
            $score = 0.3 * $matchCount; // 1 cocok = 30%, 2 = 60%, 3 = 90%

            $results[] = [
                'id' => $tanaman->id,
                'nama' => $tanaman->nama,
                'score' => $score,
                'matched_params' => $matchedParams,
            ];
        }
    }

    // Urutkan dari yang paling cocok
    usort($results, fn($a, $b) => $b['score'] <=> $a['score']);

    return $results;
}
}
