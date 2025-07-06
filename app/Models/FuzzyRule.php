<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuzzyRule extends Model
{
    use HasFactory;

    protected $table = 'fuzzy_rules';

    protected $fillable = [
        'parameter_suhu_id',
        'parameter_kelembapan_id',
        'parameter_cahaya_id',
        'tanaman_id',
        'rekomendasi'
    ];

    public function suhu()
    {
        return $this->belongsTo(Parameter::class, 'parameter_suhu_id');
    }

    public function kelembapan()
    {
        return $this->belongsTo(Parameter::class, 'parameter_kelembapan_id');
    }

    public function cahaya()
    {
        return $this->belongsTo(Parameter::class, 'parameter_cahaya_id');
    }
    public function parameterSuhu()
{
    return $this->belongsTo(Parameter::class, 'parameter_suhu_id');
}

public function parameterKelembapan()
{
    return $this->belongsTo(Parameter::class, 'parameter_kelembapan_id');
}

public function parameterCahaya()
{
    return $this->belongsTo(Parameter::class, 'parameter_cahaya_id');
}

    public function tanaman()
    {
        return $this->belongsTo(Tanaman::class, 'tanaman_id');
    }
}
