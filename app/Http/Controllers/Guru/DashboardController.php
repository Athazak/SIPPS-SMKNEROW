<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\CatatanPelanggaran;
use App\Models\CatatanPenghargaan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        // Ambil semua catatan yang dibuat oleh guru ini
        $pelanggaranList = CatatanPelanggaran::with(['siswa.user'])
            ->where('id_guru', $guru->id)
            ->get();

        $penghargaanList = CatatanPenghargaan::with(['siswa.user'])
            ->where('id_guru', $guru->id)
            ->get();

        // Hitung total
        $totalPelanggaran = $pelanggaranList->sum(fn($p) => $p->pelanggaran->skor ?? 0);
        $totalPenghargaan = $penghargaanList->sum(fn($h) => $h->penghargaan->skor ?? 0);
        $totalSkor = $totalPelanggaran - $totalPenghargaan;

        // Gabungkan rekap per siswa
        $dataSiswa = $pelanggaranList
            ->pluck('siswa')
            ->merge($penghargaanList->pluck('siswa'))
            ->unique('id')
            ->map(function ($siswa) use ($guru) {
                $totalPelanggaran = $siswa->catatanPelanggarans()
                    ->where('id_guru', $guru->id)
                    ->with('pelanggaran')
                    ->get()
                    ->sum(fn($p) => $p->pelanggaran->skor ?? 0);

                $totalPenghargaan = $siswa->catatanPenghargaans()
                    ->where('id_guru', $guru->id)
                    ->with('penghargaan')
                    ->get()
                    ->sum(fn($h) => $h->penghargaan->skor ?? 0);

                return [
                    'nama' => $siswa->user->nama,
                    'rombel' => $siswa->rombel->nama_rombel ?? '-',
                    'total_pelanggaran' => $totalPelanggaran,
                    'total_penghargaan' => $totalPenghargaan,
                    'skor_akhir' => $totalPelanggaran - $totalPenghargaan,
                ];
            })->values();

        return view('guru.dashboard', compact(
            'dataSiswa',
            'totalPelanggaran',
            'totalPenghargaan',
            'totalSkor'
        ));
    }
}
