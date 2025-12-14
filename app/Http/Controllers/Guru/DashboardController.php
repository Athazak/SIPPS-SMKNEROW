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

        $totalPelanggaran = CatatanPelanggaran::where('id_guru', $guru->id)->count();
        $totalPenghargaan = CatatanPenghargaan::where('id_guru', $guru->id)->count();

        /**
         * =========================
         * Rekap Siswa
         * =========================
         * Menampilkan siswa yang PERNAH dicatat oleh guru ini,
         * dengan jumlah pelanggaran & penghargaan (bukan skor).
         */
        $siswaPelanggaran = CatatanPelanggaran::with('siswa.user', 'siswa.rombel')
            ->where('id_guru', $guru->id)
            ->get()
            ->pluck('siswa');

        $siswaPenghargaan = CatatanPenghargaan::with('siswa.user', 'siswa.rombel')
            ->where('id_guru', $guru->id)
            ->get()
            ->pluck('siswa');

        $dataSiswa = $siswaPelanggaran
            ->merge($siswaPenghargaan)
            ->unique('id')
            ->map(function ($siswa) use ($guru) {
                return [
                    'nama' => $siswa->user->nama,
                    'rombel' => $siswa->rombel->nama_rombel ?? '-',
                    'total_pelanggaran' => $siswa->catatanPelanggarans()
                        ->where('id_guru', $guru->id)
                        ->count(),
                    'total_penghargaan' => $siswa->catatanPenghargaans()
                        ->where('id_guru', $guru->id)
                        ->count(),
                ];
            })
            ->values();

        return view('guru.dashboard', compact(
            'totalPelanggaran',
            'totalPenghargaan',
            'dataSiswa'
        ));
    }
}
