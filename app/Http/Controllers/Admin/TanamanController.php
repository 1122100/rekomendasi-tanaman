<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TanamanController extends Controller
{
    /**
     * Menampilkan daftar tanaman
     */
    public function index()
    {
        $tanaman = Tanaman::orderBy('nama')->paginate(10);
        return view('admin.tanaman.index', compact('tanaman'));
    }

    /**
     * Menampilkan form untuk membuat tanaman baru
     */
    public function create()
    {
        return view('admin.tanaman.create');
    }

    /**
     * Menyimpan tanaman baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'cara_perawatan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'nama',
            'deskripsi',
            'cara_perawatan',
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $namaFile = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/tanaman', $namaFile);
            $data['gambar'] = $namaFile;
        }

        Tanaman::create($data);

        return redirect()->route('admin.tanaman.index')
            ->with('success', 'Tanaman berhasil ditambahkan');
    }

    /**
     * Menampilkan detail tanaman
     */
    public function show(Tanaman $tanaman)
    {
        $tanaman->load([
            'fuzzyRules.parameterSuhu',
            'fuzzyRules.parameterKelembapan',
            'fuzzyRules.parameterCahaya'
        ]);
        return view('admin.tanaman.show', compact('tanaman'));
    }

    /**
     * Menampilkan form untuk mengedit tanaman
     */
    public function edit(Tanaman $tanaman)
    {
        return view('admin.tanaman.edit', compact('tanaman'));
    }

    /**
     * Memperbarui tanaman di database
     */
    public function update(Request $request, Tanaman $tanaman)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'cara_perawatan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only([
            'nama',
            'deskripsi',
            'cara_perawatan',
        ]);

        if ($request->hasFile('gambar')) {
            if ($tanaman->gambar) {
                Storage::delete('public/tanaman/' . $tanaman->gambar);
            }

            $gambar = $request->file('gambar');
            $namaFile = time() . '.' . $gambar->getClientOriginalExtension();
            $gambar->storeAs('public/tanaman', $namaFile);
            $data['gambar'] = $namaFile;
        }

        $tanaman->update($data);

        return redirect()->route('admin.tanaman.index')
            ->with('success', 'Tanaman berhasil diperbarui');
    }

    /**
     * Menghapus tanaman dari database
     */
    public function destroy(Tanaman $tanaman)
    {
        if ($tanaman->gambar) {
            Storage::delete('public/tanaman/' . $tanaman->gambar);
        }

        $tanaman->delete();

        return redirect()->route('admin.tanaman.index')
            ->with('success', 'Tanaman berhasil dihapus');
    }
}
