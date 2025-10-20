<?php

namespace App\Http\Controllers\Admin;

use App\Exports\GenericExport;
use App\Http\Controllers\Controller;
use App\Models\Rombel;
use App\Models\CatatanPelanggaran;
use App\Models\CatatanPenghargaan;
use App\Models\Siswa;
use App\Models\PenangananPelanggaran;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'pelanggaran'); // default tab pelanggaran
        $rombels = Rombel::orderBy('nama_rombel')->get();

        // ====== TAB PELANGGARAN ======
        $queryPelanggaran = CatatanPelanggaran::with(['siswa.user', 'siswa.rombel', 'guru.user', 'pelanggaran']);
        if ($request->filled('start_date'))
            $queryPelanggaran->whereDate('created_at', '>=', $request->start_date);
        if ($request->filled('end_date'))
            $queryPelanggaran->whereDate('created_at', '<=', $request->end_date);
        if ($request->filled('rombel_id')) {
            $queryPelanggaran->whereHas('siswa', fn($q) => $q->where('rombel_id', $request->rombel_id));
        }
        if ($request->filled('kategori')) {
            $queryPelanggaran->whereHas('pelanggaran', fn($q) => $q->where('jenis_pelanggaran', $request->kategori));
        }
        $catatanPelanggarans = $queryPelanggaran->latest()->paginate(10)->withQueryString();

        // ====== TAB PENGHARGAAN ======
        $queryPenghargaan = CatatanPenghargaan::with(['siswa.user', 'siswa.rombel', 'guru.user', 'penghargaan']);
        if ($request->filled('start_date'))
            $queryPenghargaan->whereDate('created_at', '>=', $request->start_date);
        if ($request->filled('end_date'))
            $queryPenghargaan->whereDate('created_at', '<=', $request->end_date);
        if ($request->filled('rombel_id')) {
            $queryPenghargaan->whereHas('siswa', fn($q) => $q->where('rombel_id', $request->rombel_id));
        }
        $catatanPenghargaans = $queryPenghargaan->latest()->paginate(10)->withQueryString();

        // ====== TAB REKAP ======
        $siswaQuery = Siswa::with(['user', 'rombel']);
        if ($request->filled('rombel_id'))
            $siswaQuery->where('rombel_id', $request->rombel_id);
        $dataRekap = $siswaQuery->get()->map(function ($siswa) {
            $totalPelanggaran = $siswa->catatanPelanggarans->sum(fn($c) => $c->pelanggaran->skor ?? 0);
            $totalPenghargaan = $siswa->catatanPenghargaans->sum(fn($c) => $c->penghargaan->skor ?? 0);
            $skorAkhir = $totalPelanggaran - $totalPenghargaan;
            $penanganan = PenangananPelanggaran::where('skor_min', '<=', $skorAkhir)
                ->where('skor_max', '>=', $skorAkhir)
                ->first();
            return [
                'nama' => $siswa->user->nama,
                'rombel' => $siswa->rombel->nama_rombel ?? '-',
                'total_pelanggaran' => $totalPelanggaran,
                'total_penghargaan' => $totalPenghargaan,
                'skor_akhir' => $skorAkhir,
                'kategori' => $penanganan->kategori ?? '-',
                'penanganan' => $penanganan->tindak_lanjut ?? '-',
            ];
        });

        return view('admin.laporan.index', compact(
            'tab',
            'rombels',
            'catatanPelanggarans',
            'catatanPenghargaans',
            'dataRekap'
        ));
    }

    public function cetak(Request $request)
    {
        $tab = $request->get('tab', 'pelanggaran');
        $format = $request->get('format', 'pdf'); // default PDF
        $rombels = Rombel::orderBy('nama_rombel')->get();

        if ($tab === 'pelanggaran') {
            $query = CatatanPelanggaran::with(['siswa.user', 'siswa.rombel', 'guru.user', 'pelanggaran']);

            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            if ($request->filled('rombel_id')) {
                $query->whereHas('siswa', fn($q) => $q->where('rombel_id', $request->rombel_id));
            }

            if ($request->filled('kategori')) {
                $query->whereHas('pelanggaran', fn($q) => $q->where('jenis_pelanggaran', $request->kategori));
            }

            $data = $query->get();

            if ($format === 'excel') {
                return Excel::download(new GenericExport($data), 'Laporan_Pelanggaran.xlsx');
            }

            $pdf = Pdf::loadView('admin.laporan.cetak_pelanggaran', compact('data', 'rombels'))
                ->setPaper('A4', 'landscape');

            return $pdf->download('Laporan_Pelanggaran.pdf');
        }

        if ($tab === 'penghargaan') {
            $query = CatatanPenghargaan::with(['siswa.user', 'siswa.rombel', 'guru.user', 'penghargaan']);

            if ($request->filled('start_date')) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }

            if ($request->filled('end_date')) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }

            if ($request->filled('rombel_id')) {
                $query->whereHas('siswa', fn($q) => $q->where('rombel_id', $request->rombel_id));
            }

            $data = $query->get();

            if ($format === 'excel') {
                return Excel::download(new GenericExport($data), 'Laporan_Penghargaan.xlsx');
            }

            $pdf = Pdf::loadView('admin.laporan.cetak_penghargaan', compact('data', 'rombels'))
                ->setPaper('A4', 'landscape');

            return $pdf->download('Laporan_Penghargaan.pdf');
        }

        if ($tab === 'rekap') {
            $siswaQuery = Siswa::with(['user', 'rombel']);
            if ($request->filled('rombel_id')) {
                $siswaQuery->where('rombel_id', $request->rombel_id);
            }

            $siswaList = $siswaQuery->get();

            $data = $siswaList->map(function ($siswa) {
                $totalPelanggaran = $siswa->catatanPelanggarans->sum(fn($c) => $c->pelanggaran->skor ?? 0);
                $totalPenghargaan = $siswa->catatanPenghargaans->sum(fn($c) => $c->penghargaan->skor ?? 0);
                $skorAkhir = $totalPelanggaran - $totalPenghargaan;
                $penanganan = PenangananPelanggaran::where('skor_min', '<=', $skorAkhir)
                    ->where('skor_max', '>=', $skorAkhir)
                    ->first();

                return [
                    'nama' => $siswa->user->nama,
                    'rombel' => $siswa->rombel->nama_rombel ?? '-',
                    'total_pelanggaran' => $totalPelanggaran,
                    'total_penghargaan' => $totalPenghargaan,
                    'skor_akhir' => $skorAkhir,
                    'penanganan' => $penanganan->tindak_lanjut ?? '-',
                    'kategori' => $penanganan->kategori ?? '-',
                ];
            });

            if ($format === 'excel') {
                return Excel::download(new GenericExport($data), 'Rekap_Skor_Siswa.xlsx');
            }

            $pdf = Pdf::loadView('admin.laporan.cetak_rekap', compact('data', 'rombels'))
                ->setPaper('A4', 'portrait');

            return $pdf->download('Rekap_Skor_Siswa.pdf');
        }

        return back()->with('error', 'Jenis laporan tidak dikenal.');
    }
}
