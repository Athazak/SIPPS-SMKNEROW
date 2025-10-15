<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{
    public function index()
    {
        $pelanggarans = Pelanggaran::latest()->paginate(10);
        return view('admin.pelanggaran.index', compact('pelanggaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pelanggan' => 'requires|in:Sikap perilaku,Kerapian,Kerajinan',
            'bentuk' => 'requires|string|max:225',
            'skor' => 'required|integer|min:1',
        ]);

        Pelanggaran::create($request->only('jenis_pelanggaran', 'bentuk', 'skor'));

        return redirect('admin.pelanggaran.index')->with('success', 'Pelanggaran berhasil ditambahkan.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
