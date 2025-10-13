<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        $siswa = User::where('role', 'siswa')->paginate(10);
        $guru = User::where('role', 'guru')->paginate(10);
        return view('admin.import.index', compact('siswa', 'guru'));
    }

    // -------------------------------
    // Siswa
    // -------------------------------
    public function previewSiswa(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);

        $import = new SiswaImport;
        Excel::import($import, $request->file('file'));

        $data = $import->data ?? []; // ambil data hasil import

        return view('admin.import.preview-siswa', compact('data'));
    }

    public function storeSiswa(Request $request)
    {
        $rows = $request->input('rows', []);

        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            $nis = trim($row['nis']);

            $exists = User::where('nis', $row['nis'])
                ->where('role', 'siswa')
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            User::create([
                'name' => $row['name'],
                'nis' => $row['nis'],
                'kelas_id' => $row['kelas_id'] ?? null,
                'alamat' => $row['alamat'] ?? null,
                'phone' => $row['phone'] ?? null,
                'email' => $row['email'],
                'status' => 'aktif',
                'role' => 'siswa',
                'password' => bcrypt('sipps123'), // default password
            ]);

            $inserted++;
        }


        return redirect()->route('admin.import.index')->with('success', "$inserted siswa berhasil disimpan. $skipped duplikat dilewati.");
    }

    public function generateOrtu()
    {
        $siswa = User::where('role', 'siswa')->get();

        $count = 0;

        foreach ($siswa as $s) {
            $ortuExist = User::where('role', 'ortu')
                ->where('email', $s->nis . '@ortu.local')
                ->exists();

            if ($ortuExist) {
                continue;
            }

            User::create([
                'name' => 'Ortu ' . $s->name,
                'email' => $s->nis . '@ortu.local',
                'password' => bcrypt('sipps123'),
                'role' => 'ortu',
                'status' => 'aktif',
                'alamat' => $s->alamat,
            ]);

            $count++;
        }

        return redirect()->route('admin.import.index')
            ->with('success', $count . ' akun orang tua berhasil dibuat.');
    }


    // -------------------------------
    // Guru
    // -------------------------------
    public function previewGuru(Request $request)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv']);

        $import = new GuruImport;
        Excel::import($import, $request->file('file'));

        $data = $import->data ?? [];

        return view('admin.import.preview-guru', compact('data'));
    }

    public function storeGuru(Request $request)
    {
        $rows = $request->input('rows', []);

        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $row) {
            $exists = User::where('nip', $row['nip'])
                ->where('role', 'guru')
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            User::create([
                'name' => $row['nama'],
                'nip' => $row['nip'],
                'alamat' => $row['alamat'] ?? null,
                'phone' => $row['phone'] ?? null,
                'email' => $row['email'],
                'role' => 'guru',
                'status' => 'aktif',
                'password' => bcrypt('sipps123'),
            ]);
            $inserted++;
        }
        
        return redirect()->route('admin.import.index')->with('success', "$inserted siswa berhasil disimpan. $skipped duplikat dilewati.");
    }
}
