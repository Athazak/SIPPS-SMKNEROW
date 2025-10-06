<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;

class JenisPelanggaranController extends Controller
{
    public function index()
    {
        $data = JenisPelanggaran::orderBy('nama_jenis')->get();
        return view('admin.jenis-pelanggaran.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_pelanggaran.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_jenis' => 'required|string|max:100']);
        JenisPelanggaran::create($request->only('nama_jenis'));
        return redirect()->route('admin.jenis-pelanggaran.index')
            ->with('success', 'Jenis pelanggaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisPelanggaran $jenis_pelanggaran)
    {
        return view('admin.jenis-pelanggaran.edit', compact('jenis_pelanggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisPelanggaran $jenis_pelanggaran)
    {
        $request->validate(['nama_jenis' => 'required|string|max:100']);
        $jenis_pelanggaran->update($request->only('nama_jenis'));
        return redirect()->route('admin.jenis-pelanggaran.index')
            ->with('success', 'Jenis pelanggaran berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisPelanggaran $jenis_pelanggaran)
    {
        $jenis_pelanggaran->delete();
        return back()->with('success', 'Jenis pelanggaran berhasil dihapus.');
    }
}
