<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\PelanggaranSiswa;
use App\Models\PenghargaanSiswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // diasumsikan akun ortu dikaitkan dengan siswa lewat field `nis` atau relasi
        $ortu = Auth::user();
        $siswa = $ortu->nis ? \App\Models\User::where('nis', $ortu->nis)->first() : null;

        $pelanggaran = $siswa ? PelanggaranSiswa::where('siswa_id', $siswa->id)->get() : collect();
        $penghargaan = $siswa ? PenghargaanSiswa::where('siswa_id', $siswa->id)->get() : collect();

        return view('ortu.dashboard.index', compact('siswa', 'pelanggaran', 'penghargaan'));
    }
}
