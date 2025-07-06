<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanaman extends Model
{
    use HasFactory;

    protected $table = 'tanamans';

    protected $fillable = [
        'nama',
        'deskripsi',
        'cara_perawatan',
        'gambar'
    ];
    /**
     * Mendapatkan semua aturan fuzzy yang terkait dengan tanaman ini
     */
    public function fuzzyRules()
    {
        return $this->hasMany(FuzzyRule::class, 'tanaman_id');
    }
}
