<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Rombel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $rombels = Rombel::orderBy('nama_rombel')->get();
        $selectedRombel = $request->get('rombel_id');

        $siswaList = collect();

        if ($selectedRombel) {
            $siswaList = Siswa::with(['user', 'rombel', 'catatanPelanggarans.pelanggaran', 'catatanPenghargaans.penghargaan'])
                ->where('rombel_id', $selectedRombel)
                ->get()
                ->map(function ($siswa) {
                    $totalPelanggaran = $siswa->catatanPelanggarans->sum(fn($c) => $c->pelanggaran->skor ?? 0);
                    $totalPenghargaan = $siswa->catatanPenghargaans->sum(fn($c) => $c->penghargaan->skor ?? 0);
                    return [
                        'id' => $siswa->id,
                        'nama' => $siswa->user->nama,
                        'rombel' => $siswa->rombel->nama_rombel,
                        'total_pelanggaran' => $totalPelanggaran,
                        'total_penghargaan' => $totalPenghargaan,
                        'skor_akhir' => $totalPelanggaran - $totalPenghargaan,
                    ];
                });
        }

        return view('guru.kelas.index', compact('rombels', 'selectedRombel', 'siswaList'));
    }

    public function show(Siswa $siswa)
    {
        $siswa->load([
            'user',
            'rombel',
            'catatanPelanggarans.pelanggaran',
            'catatanPenghargaans.penghargaan',
        ]);

        $data = [
            'id' => $siswa->id,
            'nama' => $siswa->user->nama,
            'rombel' => $siswa->rombel->nama_rombel,
            'total_pelanggaran' => $siswa->catatanPelanggarans->sum(fn($c) => $c->pelanggaran->skor ?? 0),
            'total_penghargaan' => $siswa->catatanPenghargaans->sum(fn($c) => $c->penghargaan->skor ?? 0),
            'riwayat_pelanggaran' => $siswa->catatanPelanggarans->map(fn($c) => [
                'tanggal' => $c->tanggal,
                'jenis' => $c->pelanggaran->jenis_pelanggaran ?? '-',
                'bentuk' => $c->pelanggaran->bentuk ?? '-',
                'skor' => $c->pelanggaran->skor ?? 0,
                'keterangan' => $c->keterangan ?? '-',
            ]),
            'riwayat_penghargaan' => $siswa->catatanPenghargaans->map(fn($c) => [
                'tanggal' => $c->tanggal,
                'bentuk' => $c->penghargaan->bentuk ?? '-',
                'kriteria' => $c->penghargaan->kriteria ?? '-',
                'skor' => $c->penghargaan->skor ?? 0,
            ]),
        ];

        return response()->json($data);
    }
}