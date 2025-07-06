<?php

namespace App\Http\Controllers;

use App\Models\Tanaman;
use Illuminate\Http\Request;

class GaleryController extends Controller
{
    /**
     * Display a listing of the plants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tanaman = Tanaman::with(['fuzzyrules.parameterSuhu', 'fuzzyrules.parameterKelembapan', 'fuzzyrules.parameterCahaya'])
            ->orderBy('nama')
            ->paginate(12);

        return view('users.galery', compact('tanaman'));
    }

    /**
     * Display the specified plant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tanaman = Tanaman::with(['fuzzyrules.parameterSuhu', 'fuzzyrules.parameterKelembapan', 'fuzzyrules.parameterCahaya'])
            ->findOrFail($id);

        return view('users.tanaman-detail', compact('tanaman'));
    }
}