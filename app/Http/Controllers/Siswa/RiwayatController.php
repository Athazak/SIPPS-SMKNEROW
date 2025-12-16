<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\CatatanPelanggaran;
use App\Models\CatatanPenghargaan;

class RiwayatController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;

        $totalPelanggaran = CatatanPelanggaran::where('id_siswa', $siswa->id)->count();
        $totalPenghargaan = CatatanPenghargaan::where('id_siswa', $siswa->id)->count();

        $skorAkhir = $siswa->hitungSkorAkhir();
        $statusKategori = match (true) {
            $skorAkhir >= 151 => 'berat',
            $skorAkhir >= 56 => 'sedang',
            $skorAkhir >= 10 => 'ringan',
            default => 'baik',
        };

        $pelanggarans = CatatanPelanggaran::with('pelanggaran')
            ->where('id_siswa', $siswa->id)
            ->latest()
            ->paginate(5);

        $penghargaans = CatatanPenghargaan::with('penghargaan')
            ->where('id_siswa', $siswa->id)
            ->latest()
            ->paginate(5);

        return view('siswa.riwayat.index', compact('pelanggarans', 'penghargaans', 'skorAkhir', 'statusKategori', 'totalPelanggaran', 'totalPenghargaan'));
    }
}
