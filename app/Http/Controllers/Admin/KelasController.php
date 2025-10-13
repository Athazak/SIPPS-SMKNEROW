<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data = Kelas::all();
        return view('admin.kelas.index', compact('data'));
    }

    public function create()
    {
        return view('admin.kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate(['nama_kelas' => 'required']);
        Kelas::create($request->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas ditambahkan');
    }

    public function edit(Kelas $kela)
    {
        return view('admin.kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate(['nama_kelas' => 'required']);
        $kela->update($request->all());
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas diupdate');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return back()->with('success', 'Kelas dihapus');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::orderBy('tingkat')->orderBy('jurusan')->orderBy('nama_kelas')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusanList = Kelas::select('jurusan')
            ->distinct()
            ->pluck('jurusan');

        return view('admin.kelas.create', compact('jurusanList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tingkat' => 'required|string|max:20',
            'jurusan' => 'required|string|max:100',
        ]);

        $prefix = match ($request->tingkat) {
            '1' => 'X',
            '2' => 'XI',
            '3' => 'XII',
            default => $request->tingkat,
        };

        $lastClass = Kelas::where('tingkat', $request->tingkat)
            ->where('jurusan', strtoupper($request->jurusan))
            ->orderBy('nama_kelas', 'desc')
            ->first();

        $nextNumber = 1;

        if ($lastClass && preg_match('/(\d+)$/', $lastClass->nama_kelas, $matches)) {
            $nextNumber = (int) $matches[1] + 1;
        }

        $namaKelas = $prefix . ' ' . strtoupper($request->jurusan) . ' ' . $nextNumber;

        Kelas::create([
            'tingkat' => $request->tingkat,
            'jurusan' => strtoupper($request->jurusan),
            'nama_kelas' => $namaKelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
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
    public function edit(Kelas $kelas)
    {
        $jurusanList = Kelas::select('jurusan')->distinct()->pluck('jurusan');
        return view('admin.kelas.edit', compact('kelas', 'jurusanList'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'tingkat' => 'nullable|string|max:20',
            'jurusan' => 'nullable|string|max:100',
        ]);

        $prefix = match ($request->tingkat) {
            '1' => 'X',
            '2' => 'XI',
            '3' => 'XII',
            default => $request->tingkat,
        };

        $lastClass = Kelas::where('tingkat', $request->tingkat)
            ->where('jurusan', strtoupper($request->jurusan))
            ->where('id', '!=', $kelas->id) // abaikan kelas yg sedang diedit
            ->orderBy('nama_kelas', 'desc')
            ->first();

        $nextNumber = 1;
        if ($lastClass && preg_match('/(\d+)$/', $lastClass->nama_kelas, $matches)) {
            $nextNumber = (int) $matches[1] + 1;
        }

        $namaKelas = $prefix . ' ' . strtoupper($request->jurusan) . ' ' . $nextNumber;

        $kelas->update([
            'tingkat' => $request->tingkat,
            'jurusan' => strtoupper($request->jurusan),
            'nama_kelas' => $namaKelas,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
