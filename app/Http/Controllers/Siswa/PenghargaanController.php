<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\CatatanPenghargaan;
use Illuminate\Http\Request;

class PenghargaanController extends Controller
{
    public function index()
    {
        $siswa = auth()->user()->siswa;
        $penghargaans = CatatanPenghargaan::with('penghargaan')
            ->where('id_siswa', $siswa->id)
            ->orderByDesc('tanggal')
            ->paginate(10);

        return view('siswa.penghargaan.index', compact('penghargaans'));
    }
}
