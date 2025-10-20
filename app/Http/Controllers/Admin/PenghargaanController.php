<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penghargaan;
use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    public function index()
    {
        $penghargaans = Penghargaan::latest()->paginate(10);
        return view('admin.penghargaan.index', compact('penghargaans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bentuk' => 'required|in:Berprestasi akademik & non akademik,Tidak berprestasi akademik & non akademik',
            'kriteria' => 'required|string|max:225',
            'skor' => 'required|integer|min:1',
        ]);

        Penghargaan::create($request->only('bentuk', 'kriteria', 'skor'));

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, Penghargaan $penghargaan)
    {
        $request->validate([
            'bentuk' => 'required|in:Berprestasi akademik & non akademik,Tidak berprestasi akademik & non akademik',
            'kriteria' => 'required|string|max:225',
            'skor' => 'required|integer|min:1',
        ]);

        $penghargaan->update($request->only('bentuk', 'kriteria', 'skor'));

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil diperbarui.');
    }

    public function destroy(Penghargaan $penghargaan)
    {
        $penghargaan->delete();
        return back()->with('success', 'Penghargaan berhasil dihapus.');
    }
}
