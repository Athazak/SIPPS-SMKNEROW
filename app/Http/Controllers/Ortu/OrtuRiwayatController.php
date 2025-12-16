<?php

namespace App\Http\Controllers\Ortu;

use App\Http\Controllers\Controller;
use App\Models\PenangananPelanggaran;
use Illuminate\Support\Facades\Auth;
use App\Models\CatatanPelanggaran;
use App\Models\CatatanPenghargaan;

class OrtuRiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ortu = $user->ortu ?? null;
        $siswa = $ortu?->siswa;

        if (!$siswa) {
            return view('ortu.riwayat', [
                'siswa' => null,
                'pelanggarans' => collect(),
                'penghargaan' => collect(),
                'penanganan' => null,
            ]);
        }

        // Riwayat pelanggaran (LIST)
        $pelanggarans = CatatanPelanggaran::with(['pelanggaran', 'penanganan'])
            ->where('id_siswa', $siswa->id)
            ->latest()
            ->paginate(5);

        // Riwayat penghargaan (LIST)
        $penghargaan = CatatanPenghargaan::with('penghargaan')
            ->where('id_siswa', $siswa->id)
            ->latest()
            ->paginate(5);

        // Hitung skor akhir (sesuai model siswa)
        $totalSkor = $siswa->hitungSkorAkhir();

        // Ambil level penanganan sesuai skor total
        $penanganan = PenangananPelanggaran::where('skor_min', '<=', $totalSkor)
            ->where('skor_max', '>=', $totalSkor)
            ->first();

        return view('ortu.riwayat', compact(
            'siswa',
            'pelanggarans',
            'penghargaan',
            'penanganan'
        ));
    }
}
