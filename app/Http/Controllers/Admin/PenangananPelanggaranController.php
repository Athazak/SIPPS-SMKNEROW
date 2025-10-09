<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenangananPelanggaran;
use Illuminate\Http\Request;

class PenangananPelanggaranController extends Controller
{
    public function index()
    {
        $penanganan = PenangananPelanggaran::orderBy('skor_min')->get();
        return view('admin.penanganan.index', compact('penanganan'));
    }

    public function create()
    {
        return view('admin.penanganan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:100',
            'skor_min' => 'required|integer|min:0',
            'skor_maks' => 'nullable|integer|gte:skor_min',
            'tindak_lanjut' => 'required|string',
        ]);

        PenangananPelanggaran::create($request->only('kategori', 'skor_min', 'skor_maks', 'tindak_lanjut'));

        return redirect()->route('admin.penanganan.index')->with('success', 'Data penanganan berhasil ditambahkan.');
    }

    public function edit(PenangananPelanggaran $penanganan)
    {
        return view('admin.penanganan.edit', compact('penanganan'));
    }

    public function update(Request $request, PenangananPelanggaran $penanganan)
    {
        $request->validate([
            'kategori' => 'required|string|max:100',
            'skor_min' => 'required|integer|min:0',
            'skor_maks' => 'nullable|integer|gte:skor_min',
            'tindak_lanjut' => 'required|string',
        ]);

        $penanganan->update($request->only('kategori', 'skor_min', 'skor_maks', 'tindak_lanjut'));

        return redirect()->route('admin.penanganan.index')->with('success', 'Data penanganan berhasil diperbarui.');
    }

    public function destroy(PenangananPelanggaran $penanganan)
    {
        $penanganan->delete();
        return redirect()->route('admin.penanganan.index')->with('success', 'Data penanganan berhasil dihapus.');
    }
}
