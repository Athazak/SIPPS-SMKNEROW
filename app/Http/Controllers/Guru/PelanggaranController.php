<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PelanggaranSiswa;
use App\Models\BentukPelanggaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelanggaranController extends Controller
{
    public function index()
    {
        $data = PelanggaranSiswa::with('siswa', 'bentuk')->latest()->paginate(10);
        return view('guru.pelanggaran.index', compact('data'));
    }

    public function create()
    {
        $siswa = User::where('role', 'siswa')->get();
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
