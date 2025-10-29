<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CatatanPelanggaran;
use App\Models\CatatanPenghargaan;
use App\Models\PenangananPelanggaran;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        // Total skor
        $totalPelanggaran = CatatanPelanggaran::where('id_siswa', $siswa->id)
            ->with('pelanggaran')
            ->get()
            ->sum(fn($c) => $c->pelanggaran->skor ?? 0);

        $totalPenghargaan = CatatanPenghargaan::where('id_siswa', $siswa->id)
            ->with('penghargaan')
            ->get()
            ->sum(fn($c) => $c->penghargaan->skor ?? 0);

        $skorAkhir = $totalPelanggaran - $totalPenghargaan;

        // Level penanganan
        $penanganan = PenangananPelanggaran::where('skor_min', '<=', $skorAkhir)
            ->where('skor_max', '>=', $skorAkhir)
            ->first();

        // Notifikasi terbaru (5 terakhir)
        $notifikasi = collect()
            ->merge(
                CatatanPelanggaran::with('pelanggaran')
                    ->where('id_siswa', $siswa->id)
                    ->latest()->take(3)->get()
                    ->map(fn($c) => [
                        'tipe' => 'pelanggaran',
                        'pesan' => "Anda mendapat pelanggaran: " . ($c->pelanggaran->bentuk ?? '-'),
                        'tanggal' => $c->created_at->format('d/m/Y'),
                    ])
            )
            ->merge(
                CatatanPenghargaan::with('penghargaan')
                    ->where('id_siswa', $siswa->id)
                    ->latest()->take(3)->get()
                    ->map(fn($c) => [
                        'tipe' => 'penghargaan',
                        'pesan' => "Anda mendapat penghargaan: " . ($c->penghargaan->bentuk ?? '-'),
                        'tanggal' => $c->created_at->format('d/m/Y'),
                    ])
            )
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();

        return view('siswa.dashboard', compact(
            'user',
            'siswa',
            'totalPelanggaran',
            'totalPenghargaan',
            'skorAkhir',
            'penanganan',
            'notifikasi'
        ));
    }
}
