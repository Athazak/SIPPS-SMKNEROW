<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Imports\GuruImport;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user')->latest()->paginate(10);

        return view('admin.guru.index', compact('guru'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        return back()->with('success', 'Import guru berhasil diproses (chunk). Username = 6 digit tanggal lahir, password = 123456');
    }
}
