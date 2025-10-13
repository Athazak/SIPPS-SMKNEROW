<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Rombel;
use App\Models\Pelanggaran;
use App\Models\Penghargaan;
use App\Models\CatatanPelanggaran;
use App\Models\CatatanPenghargaan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ringkasan total
        $total = [
            'guru' => Guru::count(),
            'siswa' => Siswa::count(),
            'rombel' => Rombel::count(),
            'pelanggaran' => Pelanggaran::count(),
            'penghargaan' => Penghargaan::count(),
        ];

        // Statistik per bulan (12 bulan terakhir)
        $pelanggaranPerBulan = CatatanPelanggaran::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('COUNT(*) as total')
        )->whereYear('tanggal', date('Y'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $penghargaanPerBulan = CatatanPenghargaan::select(
            DB::raw('MONTH(tanggal) as bulan'),
            DB::raw('COUNT(*) as total')
        )->whereYear('tanggal', date('Y'))
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Susun label bulan & isi nilai 0 jika kosong
        $bulanNama = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $pelanggaranChart = [];
        $penghargaanChart = [];

        for ($i = 1; $i <= 12; $i++) {
            $pelanggaranChart[] = $pelanggaranPerBulan[$i] ?? 0;
            $penghargaanChart[] = $penghargaanPerBulan[$i] ?? 0;
        }

        return view('admin.dashboard', compact('total', 'bulanNama', 'pelanggaranChart', 'penghargaanChart'));
    }
}
