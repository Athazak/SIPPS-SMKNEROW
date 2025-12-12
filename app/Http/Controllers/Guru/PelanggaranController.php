<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Pelanggaran;
use App\Models\CatatanPelanggaran;
use App\Models\PenangananPelanggaran;

class PelanggaranController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;

        // Ambil catatan pelanggaran milik guru ini
        $catatan = CatatanPelanggaran::with(['siswa.user', 'siswa.rombel', 'pelanggaran'])
            ->where('id_guru', $guru->id)
            ->latest()
            ->paginate(10);

        // Data untuk modal tambah
        $siswa = Siswa::with(['user', 'rombel'])
            ->orderBy('rombel_id')
            ->get();

        $pelanggarans = Pelanggaran::orderBy('jenis_pelanggaran')->get();

        return view('guru.pelanggaran.index', compact('catatan', 'siswa', 'pelanggarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'pelanggaran_id' => 'required|exists:pelanggarans,id',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $guru = Auth::user()->guru;

        // Simpan catatan pelanggaran baru dengan tanggal otomatis
        $catatan = CatatanPelanggaran::create([
            'id_siswa' => $request->siswa_id,
            'id_guru' => $guru->id,
            'id_pelanggaran' => $request->pelanggaran_id,
            'keterangan' => $request->keterangan,
            'tanggal' => now(),
        ]);

        // Hitung ulang total skor siswa
        $totalSkor = CatatanPelanggaran::where('id_siswa', $request->siswa_id)
            ->with('pelanggaran')
            ->get()
            ->sum(fn($item) => $item->pelanggaran->skor ?? 0);

        // Cari level penanganan berdasarkan skor total
        $penanganan = PenangananPelanggaran::where('skor_min', '<=', $totalSkor)
            ->where('skor_max', '>=', $totalSkor)
            ->first();

        // Update catatan terbaru dengan id penanganan (jika ada)
        if ($penanganan) {
            $catatan->update(['id_penanganan' => $penanganan->id]);
        }

        return redirect()
            ->route('guru.pelanggaran.index')
            ->with('success', 'Catatan pelanggaran berhasil ditambahkan.');
    }
}
