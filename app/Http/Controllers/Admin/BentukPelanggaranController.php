<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BentukPelanggaran;
use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;

class BentukPelanggaranController extends Controller
{
    public function index()
    {
        $data = BentukPelanggaran::with('jenis')->orderBy('id', 'desc')->paginate(10);
        $jenisList = JenisPelanggaran::orderBy('nama_jenis')->get();
        return view('admin.bentuk-pelanggaran.index', compact('data', 'jenisList'));
    }

    public function create()
    {
        $jenis = JenisPelanggaran::orderBy('nama_jenis')->get();
        return view('admin.bentuk-pelanggaran.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_id' => 'required|exists:jenis_pelanggarans,id',
            'bentuk' => 'required|string|max:255',
            'skor' => 'required|integer|min:0',
        ]);

        BentukPelanggaran::create($request->only('jenis_id', 'bentuk', 'skor', 'sanksi'));
        return redirect()->route('admin.bentuk-pelanggaran.index')
            ->with('success', 'Bentuk pelanggaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(BentukPelanggaran $bentuk_pelanggaran)
    {
        $jenis = JenisPelanggaran::orderBy('nama_jenis')->get();
        return view('admin.bentuk-pelanggaran.edit', compact('bentuk_pelanggaran', 'jenis'));
    }

    public function update(Request $request, BentukPelanggaran $bentuk_pelanggaran)
    {
        $request->validate([
            'jenis_id' => 'required|exists:jenis_pelanggarans,id',
            'bentuk' => 'required|string|max:255',
            'skor' => 'required|integer|min:0',
        ]);

        $bentuk_pelanggaran->update($request->only('jenis_id', 'bentuk', 'skor', 'sanksi'));
        return redirect()->route('admin.bentuk-pelanggaran.index')
            ->with('success', 'Bentuk pelanggaran berhasil diupdate.');
    }

    public function destroy(BentukPelanggaran $bentuk_pelanggaran)
    {
        $bentuk_pelanggaran->delete();
        return back()->with('success', 'Bentuk pelanggaran berhasil dihapus.');
    }
}
