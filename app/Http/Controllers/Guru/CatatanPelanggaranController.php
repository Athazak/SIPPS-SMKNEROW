<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\CatatanPelanggaran;
use App\Models\BentukPelanggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatatanPelanggaranController extends Controller
{
    public function index()
    {
        $catatan = CatatanPelanggaran::with(['siswa', 'bentuk'])
            ->where('guru_id', Auth::user()->guru->id)
            ->latest()->paginate(10);

        return view('guru.pelanggaran.index', compact('catatan'));
    }

    public function create()
    {
        $siswas = User::where('role', 'siswa')->get();
        $bentuk = BentukPelanggaran::all();
        return view('guru.pelanggaran.create', compact('siswa', 'bentuk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'bentuk_pelanggaran_id' => 'required',
            'tanggal' => 'required|date',
        ]);

        PelanggaranSiswa::create([
            'siswa_id' => $request->siswa_id,
            'bentuk_pelanggaran_id' => $request->bentuk_pelanggaran_id,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'guru_id' => Auth::id(),
        ]);

        return redirect()->route('guru.pelanggaran.index')->with('success', 'Pelanggaran berhasil dicatat');
    }
}
