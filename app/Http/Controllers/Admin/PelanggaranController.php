<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggaran::query();

        // Jika ada parameter search, lakukan filter
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;

            $query->where('jenis_pelanggaran', 'like', "%$search%")
                ->orWhere('bentuk', 'like', "%$search%")
                ->orWhere('skor', 'like', "%$search%");
        }

        $pelanggarans = $query->orderBy('jenis_pelanggaran')
            ->orderBy('bentuk')
            ->orderBy('skor')
            ->paginate(10)
            ->withQueryString();

        return view('admin.pelanggaran.index', compact('pelanggarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_pelanggaran' => 'required|in:Sikap perilaku,Kerapian,Kerajinan',
            'bentuk' => 'required|string|max:225',
            'skor' => 'required|integer|min:1',
        ]);

        Pelanggaran::create($request->only('jenis_pelanggaran', 'bentuk', 'skor'));

        return redirect()->route('admin.pelanggaran.index')->with('success', 'Pelanggaran Pelanggaran berhasil ditambahkan.');
    }

    public function update(Request $request, Pelanggaran $pelanggaran)
    {
        $request->validate([
            'jenis_pelanggaran' => 'required|in:Sikap perilaku,Kerapian,Kerajinan',
            'bentuk' => 'required|string|max:225',
            'skor' => 'required|integer|min:1',
        ]);

        $pelanggaran->update($request->only('jenis_pelanggaran', 'bentuk', 'skor'));

        return redirect()->route('admin.pelanggaran.index')->with('success', 'Pelanggaran Pelanggaran berhasil diperbarui.');
    }

    public function destroy(Pelanggaran $pelanggaran)
    {
        $pelanggaran->delete();
        return back()->with('success', 'Pelanggaran berhasil dihapus.');
    }
}
