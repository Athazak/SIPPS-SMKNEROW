<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function guruIndex()
    {
        $data = User::where('role', 'guru')->get();
        return view('admin.guru.index', compact('data'));
    }

    public function siswaIndex()
    {
        $data = User::where('role', 'siswa')->with('kelas')->get();
        return view('admin.siswa.index', compact('data'));
    }

    public function createGuru()
    {
        return view('admin.guru.create');
    }

    public function createSiswa()
    {
        $kelas = Kelas::all();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function storeGuru(Request $request)
    {
        $request->validate(['name' => 'required', 'nip' => 'required']);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'role' => 'guru',
            'nip' => $request->nip,
            'phone' => $request->phone,
            'status' => 'aktif'
        ]);
        return redirect()->route('admin.guru.index')->with('success', 'Guru ditambahkan');
    }

    public function storeSiswa(Request $request)
    {
        $request->validate(['name' => 'required', 'nis' => 'required', 'kelas_id' => 'required']);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'role' => 'siswa',
            'nis' => $request->nis,
            'kelas_id' => $request->kelas_id,
            'status' => 'aktif'
        ]);
        return redirect()->route('admin.siswa.index')->with('success', 'Siswa ditambahkan');
    }
}
