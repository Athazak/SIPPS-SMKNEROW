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
        // Ambil data ortu yang sedang login
        $ortu = Auth::user();

        // Ambil data siswa yang terhubung dengan ortu
        $siswa = $ortu->ortu?->siswa;

        if (!$siswa) {
            return view('ortu.riwayat')->with([
                'siswa' => null,
                'pelanggarans' => [],
                'penghargaan' => [],
                'penanganan' => null,
            ]);
        }

        // Ambil catatan pelanggaran dan penghargaan anak
        $pelanggarans = CatatanPelanggaran::with(['pelanggaran', 'penanganan'])
            ->where('id_siswa', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        $penghargaan = CatatanPenghargaan::with(['penghargaan'])
            ->where('id_siswa', $siswa->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung total skor siswa
        $totalSkor = $siswa->catatanPelanggarans()
            ->with('pelanggaran')
            ->get()
            ->sum(fn($item) => $item->pelanggaran->skor ?? 0);

        // Ambil level penanganan sesuai skor total
        $penanganan = PenangananPelanggaran::where('skor_min', '<=', $totalSkor)
            ->where('skor_max', '>=', $totalSkor)
            ->first();

        return view('ortu.riwayat', [
            'siswa' => $siswa,
            'pelanggarans' => $pelanggarans,
            'penghargaan' => $penghargaan,
            'penanganan' => $penanganan,
        ]);
    }
}
