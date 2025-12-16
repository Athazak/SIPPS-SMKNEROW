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

        $totalPelanggaran = CatatanPelanggaran::where('id_siswa', $siswa->id)->count();
        $totalPenghargaan = CatatanPenghargaan::where('id_siswa', $siswa->id)->count();
        $skorAkhir = $siswa->hitungSkorAkhir();

        $penanganan = PenangananPelanggaran::where('skor_min', '<=', $skorAkhir)
            ->where('skor_max', '>=', $skorAkhir)
            ->first();

        $pelanggaranTerbaru = CatatanPelanggaran::where('id_siswa', $siswa->id)
            ->with('pelanggaran')->latest()->take(3)->get();

        $penghargaanTerbaru = CatatanPenghargaan::where('id_siswa', $siswa->id)
            ->with('penghargaan')->latest()->take(3)->get();


        $tanggalTerakhir = collect($pelanggaranTerbaru)
            ->pluck('tanggal')
            ->merge(collect($penghargaanTerbaru)->pluck('tanggal'))
            ->sortDesc()
            ->first();

        $riwayat = collect($pelanggaranTerbaru)
            ->map(fn($p) => [
                'tanggal' => \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y'),
                'tipe' => 'pelanggaran',
                'pesan' => $p->pelanggaran->bentuk ?? '-'
            ])
            ->merge(
                collect($penghargaanTerbaru)->map(fn($h) => [
                    'tanggal' => \Carbon\Carbon::parse($h->tanggal)->format('d/m/Y'),
                    'tipe' => 'penghargaan',
                    'pesan' => $h->penghargaan->bentuk ?? '-'
                ])
            )
            ->sortByDesc('tanggal')
            ->take(6)
            ->values();

        return view('ortu.dashboard', compact(
            'siswa',
            'totalPelanggaran',
            'totalPenghargaan',
            'skorAkhir',
            'penanganan',
            'pelanggaranTerbaru',
            'penghargaanTerbaru',
            'tanggalTerakhir',
            'riwayat'
        ));
    }
}
