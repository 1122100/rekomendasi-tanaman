<?php

namespace App\Services;

use App\Models\FuzzyRule;
use App\Models\Parameter;

class FuzzyService
{
    /**
     * Process environmental data using Mamdani Fuzzy Logic
     *
     * @param array $environmentData Array containing 'suhu', 'kelembapan', 'cahaya' values
     * @return array Results with recommendations and scores
     */
    public function processEnvironmentData(array $environmentData)
    {
        // 1. Fuzzification - convert crisp inputs to fuzzy values
        $fuzzyValues = $this->fuzzify($environmentData);

        // 2. Rule evaluation - apply fuzzy rules
        $ruleResults = $this->evaluateRules($fuzzyValues);

        // 3. Aggregation of rule outputs
        $aggregatedOutput = $this->aggregateRuleOutputs($ruleResults);

        // 4. Defuzzification - convert fuzzy output to crisp value
        $recommendations = $this->defuzzify($aggregatedOutput);

        return [
            'recommendations' => $recommendations,
            'fuzzy_values' => $fuzzyValues,
            'rule_results' => $ruleResults,
        ];
    }

    /**
     * Fuzzify crisp input values
     */
    private function fuzzify(array $environmentData)
    {
        $result = [];

        // Get all parameters
        $parameters = Parameter::all()->groupBy('type');

        // Process each environmental input
        foreach (['suhu', 'kelembapan', 'cahaya'] as $type) {
            $value = $environmentData[$type] ?? 0;
            $result[$type] = [];

            // Calculate membership degree for each parameter of this type
            foreach ($parameters->get($type, collect()) as $param) {
                $membershipDegree = $this->calculateMembershipDegree($value, $param->min, $param->max);
                $result[$type][$param->id] = [
                    'label' => $param->label,
                    'degree' => $membershipDegree
                ];
            }
        }

        return $result;
    }

    /**
     * Calculate membership degree using trapezoidal function
     */
    private function calculateMembershipDegree($value, $min, $max)
    {
        // Simple trapezoidal membership function
        if ($value <= $min) {
            return 0;
        } elseif ($value >= $max) {
            return 1;
        } else {
            return ($value - $min) / ($max - $min);
        }
    }

    /**
     * Evaluate all fuzzy rules
     */
    private function evaluateRules(array $fuzzyValues)
    {
        $results = [];

        // Get all rules
        $rules = FuzzyRule::all();

        foreach ($rules as $rule) {
            // Apply MIN operator for AND condition
            $suhuDegree = $fuzzyValues['suhu'][$rule->parameter_suhu_id]['degree'] ?? 0;
            $kelembapanDegree = $fuzzyValues['kelembapan'][$rule->parameter_kelembapan_id]['degree'] ?? 0;
            $cahayaDegree = $fuzzyValues['cahaya'][$rule->parameter_cahaya_id]['degree'] ?? 0;

            // Get minimum value as rule firing strength
            $firingStrength = min($suhuDegree, $kelembapanDegree, $cahayaDegree);

            $results[] = [
                'rule_id' => $rule->id,
                'rekomendasi' => $rule->rekomendasi,
                'firing_strength' => $firingStrength
            ];
        }

        return $results;
    }

    /**
     * Aggregate rule outputs
     */
    private function aggregateRuleOutputs(array $ruleResults)
    {
        //agregasi
        $aggregated = [];

        // Group by recommendation
        foreach ($ruleResults as $result) {
            $rekomendasi = $result['rekomendasi'];

            if (!isset($aggregated[$rekomendasi])) {
                $aggregated[$rekomendasi] = 0;
            }

            // Apply MAX operator for OR condition between rules
            $aggregated[$rekomendasi] = max($aggregated[$rekomendasi], $result['firing_strength']);
        }

        return $aggregated;
    }

    /**
     * Defuzzify using centroid method
     */
    private function defuzzify(array $aggregatedOutput)
    {
        $recommendations = [];

        // Defuzzifikasi
        arsort($aggregatedOutput);

        // Convert to array of recommendations with scores
        foreach ($aggregatedOutput as $rekomendasi => $score) {
            if ($score > 0) {  // Only include recommendations with non-zero scores
                $recommendations[] = [
                    'tanaman' => $rekomendasi,
                    'score' => $score
                ];
            }
        }

        return $recommendations;
    }
}
