<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PelanggaranSiswa;
use App\Models\PenghargaanSiswa;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahSiswa = User::where('role', 'siswa')->count();
        $jumlahGuru = User::where('role', 'guru')->count();
        $pelanggaran = PelanggaranSiswa::count();
        $penghargaan = PenghargaanSiswa::count();

        return view('admin.dashboard.index', compact('jumlahSiswa', 'jumlahGuru', 'pelanggaran', 'penghargaan'));
    }
}
