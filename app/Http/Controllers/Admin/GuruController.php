<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Imports\GuruImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $guru = Guru::with('user')
            ->join('users', 'users.id', '=', 'gurus.user_id')
            ->when($search, function ($query, $search) {
                return $query->where('users.nama', 'like', "%{$search}%")
                    ->orWhere('gurus.nip', 'like', "%{$search}%")
                    ->orWhere('users.username', 'like', "%{$search}%")
                    ->orWhere('gurus.nuptk', 'like', "%{$search}%");
            })
            ->orderBy('users.nama')
            ->select('gurus.*')
            ->paginate(10)
            ->withQueryString();

        // Ambil hasil import seperti di siswa
        $result = session('import_result');

        return view('admin.guru.index', compact('guru', 'search', 'result'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new GuruImport, $request->file('file'));

        // Ambil hasil import dari GuruImport
        $result = session('import_result', [
            'total' => 0,
            'inserted' => 0,
            'skipped' => 0,
        ]);

        return redirect()->route('admin.guru.index')->with('import_result', $result);
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);

        $defaultPassword = '123456';

        $user->password = Hash::make($defaultPassword);
        $user->save();

        return back()->with('success', "Password untuk {$user->nama} telah direset ke sandi default: 123456");
    }
}
