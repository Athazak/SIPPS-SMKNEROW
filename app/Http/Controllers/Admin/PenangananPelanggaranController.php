<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenangananPelanggaran;
use Illuminate\Http\Request;

class PenangananPelanggaranController extends Controller
{
    public function index()
    {
        $penanganans = PenangananPelanggaran::latest()->paginate(10);
        return view('admin.penanganan.index', compact('penanganans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:ringan,sedang,berat',
            'skor_min' => 'required|integer|min:1',
            'skor_max' => 'required|integer|min:1|gte:skor_min',
            'tindak_lanjut' => 'required|string|max:255',
        ]);

        PenangananPelanggaran::create($request->only('kategori', 'skor_min', 'skor_max', 'tindak_lanjut'));

        return redirect()->route('admin.penanganan.index')->with('success', 'Penanganan berhasil ditambahkan.');
    }

    public function update(Request $request, PenangananPelanggaran $penanganan)
    {
        $request->validate([
            'kategori' => 'required|in:ringan,sedang,berat',
            'skor_min' => 'required|integer|min:1',
            'skor_max' => 'required|integer|min:1|gte:skor_min',
            'tindak_lanjut' => 'required|string|max:255',
        ]);

        $penanganan->update($request->only('kategori', 'skor_min', 'skor_max', 'tindak_lanjut'));

        return redirect()->route('admin.penanganan.index')->with('success', 'Penanganan berhasil diperbarui.');
    }

    public function destroy(PenangananPelanggaran $penanganan)
    {
        $penanganan->delete();
        return back()->with('success', 'Penanganan pelanggaran berhasil dihapus.');
    }
}
