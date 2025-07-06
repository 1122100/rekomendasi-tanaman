<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecommendationResult extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'input_data',
        'results',
    ];
    
    protected $casts = [
        'input_data' => 'array',
        'results' => 'array',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}