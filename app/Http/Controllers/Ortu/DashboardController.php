<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\CatatanPelanggaran;
use App\Models\CatatanPenghargaan;
use App\Models\PenangananPelanggaran;

class DashboardController extends Controller
{
    public function index()
    {
        $ortu = Auth::user()->ortu;
        $siswa = Siswa::with(['user', 'rombel'])->find($ortu->siswa_id);

        $totalPelanggaran = CatatanPelanggaran::where('id_siswa', $siswa->id)
            ->with('pelanggaran')->get()->sum(fn($p) => $p->pelanggaran->skor ?? 0);

        $totalPenghargaan = CatatanPenghargaan::where('id_siswa', $siswa->id)
            ->with('penghargaan')->get()->sum(fn($h) => $h->penghargaan->skor ?? 0);

        $skorAkhir = $totalPelanggaran - $totalPenghargaan;

        $penanganan = PenangananPelanggaran::where('skor_min', '<=', $skorAkhir)
            ->where('skor_max', '>=', $skorAkhir)
            ->first();

        $pelanggaranTerbaru = CatatanPelanggaran::where('id_siswa', $siswa->id)
            ->with('pelanggaran')->latest()->take(3)->get();

        $penghargaanTerbaru = CatatanPenghargaan::where('id_siswa', $siswa->id)
            ->with('penghargaan')->latest()->take(3)->get();

        return view('ortu.dashboard', compact(
            'siswa',
            'totalPelanggaran',
            'totalPenghargaan',
            'skorAkhir',
            'penanganan',
            'pelanggaranTerbaru',
            'penghargaanTerbaru'
        ));
    }
}
