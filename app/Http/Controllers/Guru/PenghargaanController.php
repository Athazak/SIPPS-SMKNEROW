<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Penghargaan;
use App\Models\CatatanPenghargaan;

class PenghargaanController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        // Ambil catatan penghargaan milik guru ini
        $catatan = CatatanPenghargaan::with(['siswa.user', 'siswa.rombel', 'penghargaan'])
            ->where('id_guru', $guru->id)
            ->latest()
            ->paginate(10);

        // Data untuk modal tambah
        $siswa = Siswa::with(['user', 'rombel'])
            ->orderBy('rombel_id')
            ->get();

        $penghargaans = Penghargaan::orderBy('bentuk')->get();

        return view('guru.penghargaan.index', compact('catatan', 'siswa', 'penghargaans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'penghargaan_id' => 'required|exists:penghargaans,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $guru = Auth::user()->guru;

        if (!$guru) {
            abort(403, 'Akun ini tidak terhubung sebagai guru.');
        }

        // Simpan catatan penghargaan baru
        CatatanPenghargaan::create([
            'id_siswa' => $request->siswa_id,
            'id_guru' => $guru->id,
            'id_penghargaan' => $request->penghargaan_id,
            'keterangan' => $request->keterangan,
            'tanggal' => now(),
        ]);

        return redirect()
            ->route('guru.penghargaan.index')
            ->with('success', 'Catatan penghargaan berhasil ditambahkan.');
    }
}
