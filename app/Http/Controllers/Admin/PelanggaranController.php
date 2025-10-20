<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        $pelanggarans = Pelanggaran::latest()->paginate(10);
        return view('admin.pelanggaran.index', compact('pelanggarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pelanggaran' => 'required|in:Sikap perilaku,Kerapian,Kerajinan',
            'bentuk' => 'required|string|max:225',
            'skor' => 'required|integer|min:1',
        ]);

        Pelanggaran::create($request->only('jenis_pelanggaran', 'bentuk', 'skor'));

        return redirect()->route('admin.pelanggaran.index')->with('success', 'Pelanggaran Pelanggaran berhasil ditambahkan.');
    }

    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'jenis_pelanggaran' => 'required|in:Sikap perilaku,Kerapian,Kerajinan',
            'bentuk' => 'required|string|max:225',
            'skor' => 'required|integer|min:1',
        ]);

        $pelanggaran->update($request->only('jenis_pelanggaran', 'bentuk', 'skor'));

        return redirect()->route('admin.pelanggaran.index')->with('success', 'Pelanggaran Pelanggaran berhasil diperbarui.');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        return back()->with('success', 'Pelanggaran berhasil dihapus.');
    }
}
