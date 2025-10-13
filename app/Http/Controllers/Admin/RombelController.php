<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rombel;
use Illuminate\Http\Request;

class RombelController extends Controller
{
    public function index()
    {
        $rombels = Rombel::orderBy('tingkat')->orderBy('jurusan')->orderBy('nama_rombel')->paginate(10);
        return view('admin.rombel.index', compact('rombels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'required|string|max:100',
            'nama_rombel' => 'required|string|max:100|unique:rombels,nama_rombel',
        ]);

        Rombel::create($request->only('tingkat', 'jurusan', 'nama_rombel'));

        return redirect()->route('admin.rombel.index')->with('success', 'Rombel berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, Rombel $rombel)
    {
        $request->validate([
            'tingkat' => 'required|in:X,XI,XII',
            'jurusan' => 'required|string|max:100',
            'nama_rombel' => 'required|string|max:100|unique:rombels,nama_rombel,' . $rombel->id,
        ]);

        $rombel->update($request->only('tingkat', 'jurusan', 'nama_rombel'));

        return redirect()->route('admin.rombel.index')->with('success', 'Rombel berhasil diperbarui.');
    }

    public function destroy(Rombel $rombel)
    {
        $rombel->delete();
        return back()->with('success', 'Rombel berhasil dihapus.');
    }
}
