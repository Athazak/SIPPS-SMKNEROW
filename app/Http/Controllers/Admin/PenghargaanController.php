<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penghargaan;
use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    public function index()
    {
        $penghargaans = Penghargaan::orderBy('bentuk')->get();
        return view('admin.penghargaan.index', compact('penghargaans'));
    }

    public function create()
    {
        return view('admin.penghargaan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bentuk' => 'required|string|max:150',
            'kriteria' => 'required|string',
            'skor' => 'required|integer|min:0',
        ]);

        Penghargaan::create($request->only('bentuk', 'kriteria', 'skor'));

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil ditambahkan.');
    }

    public function show(string $id)
    {

    }

    public function edit(Penghargaan $penghargaan)
    {
        return view('admin.penghargaan.edit', compact('penghargaan'));
    }

    public function update(Request $request, Penghargaan $penghargaan)
    {
        $request->validate([
            'bentuk' => 'required|string|max:150',
            'kriteria' => 'required|string',
            'skor' => 'required|integer|min:0',
        ]);

        $penghargaan->update($request->only('bentuk', 'kriteria', 'skor'));

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil diperbarui.');
    }

    public function destroy(Penghargaan $penghargaan)
    {
        $penghargaan->delete();

        return redirect()->route('admin.penghargaan.index')->with('success', 'Penghargaan berhasil dihapus.');
    }
}
