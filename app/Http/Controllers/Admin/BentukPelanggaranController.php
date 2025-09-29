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
        $data = BentukPelanggaran::with('jenis')->get();
        return view('admin.bentuk.index', compact('data'));
    }

    public function create()
    {
        $jenis = JenisPelanggaran::all();
        return view('admin.bentuk.create', compact('jenis'));
    }

    public function store(Request $request)
    {
        $request->validate(['bentuk' => 'required', 'jenis_id' => 'required']);
        BentukPelanggaran::create($request->all());
        return redirect()->route('admin.bentuk.index')->with('success', 'Bentuk Pelanggaran ditambahkan');
    }

    public function edit(BentukPelanggaran $bentuk)
    {
        $jenis = JenisPelanggaran::all();
        return view('admin.bentuk.edit', compact('bentuk', 'jenis'));
    }

    public function update(Request $request, BentukPelanggaran $bentuk)
    {
        $request->validate(['bentuk' => 'required', 'jenis_id' => 'required']);
        $bentuk->update($request->all());
        return redirect()->route('admin.bentuk.index')->with('success', 'Bentuk Pelanggaran diupdate');
    }

    public function destroy(BentukPelanggaran $bentuk)
    {
        $bentuk->delete();
        return back()->with('success', 'Bentuk Pelanggaran dihapus');
    }
}
