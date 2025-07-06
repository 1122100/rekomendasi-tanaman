<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tanaman;
class HomeController extends Controller
{
    public function index()
    {
        $plants = Tanaman::with([
                        'fuzzyrules.parameterSuhu',
                        'fuzzyrules.parameterKelembapan',
                        'fuzzyrules.parameterCahaya'
                    ])
                    ->latest()   // urutkan berdasarkan created_at DESC
                    ->take(4)    // ambil 4 data
                    ->get();

        return view('users.home', compact('plants'));
    }
}
