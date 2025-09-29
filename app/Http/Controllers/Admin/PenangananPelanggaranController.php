<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenangananPelanggaran;
use Illuminate\Http\Request;

class PenangananPelanggaranController extends Controller
{
    public function index()
    {
        $data = PenangananPelanggaran::all();
        return view('admin.penanganan.index', compact('data'));
    }

    public function create()
    {
        return view('admin.penanganan.create');
    }

    public function store(Request $request)
    {
        $request->validate(['kategori' => 'required', 'skor_min' => 'required', 'skor_max' => 'required']);
        PenangananPelanggaran::create($request->all());
        return redirect()->route('admin.penanganan.index')->with('success', 'Penanganan ditambahkan');
    }

    public function edit(PenangananPelanggaran $penanganan)
    {
        return view('admin.penanganan.edit', compact('penanganan'));
    }

    public function update(Request $request, PenangananPelanggaran $penanganan)
    {
        $request->validate(['kategori' => 'required', 'skor_min' => 'required', 'skor_max' => 'required']);
        $penanganan->update($request->all());
        return redirect()->route('admin.penanganan.index')->with('success', 'Penanganan diupdate');
    }

    public function destroy(PenangananPelanggaran $penanganan)
    {
        $penanganan->delete();
        return back()->with('success', 'Penanganan dihapus');
    }
}
