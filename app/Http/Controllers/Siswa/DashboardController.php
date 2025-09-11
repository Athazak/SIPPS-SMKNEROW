<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\PelanggaranSiswa;
use App\Models\PenghargaanSiswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswaId = Auth::id();
        $pelanggaran = PelanggaranSiswa::where('siswa_id', $siswaId)->with('bentuk')->get();
        $penghargaan = PenghargaanSiswa::where('siswa_id', $siswaId)->with('penghargaan')->get();

        return view('siswa.dashboard.index', compact('pelanggaran', 'penghargaan'));
    }
}
