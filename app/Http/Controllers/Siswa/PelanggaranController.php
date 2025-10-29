<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\CatatanPelanggaran;

class PelanggaranController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $pelanggarans = CatatanPelanggaran::with(['pelanggaran', 'penanganan'])
            ->where('id_siswa', $siswa->id)
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('siswa.pelanggaran.index', compact('pelanggarans'));
    }
}
