<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use App\Imports\SiswaImport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $siswas = Siswa::with(['user', 'rombel', 'ortu.user'])
            ->join('users', 'users.id', '=', 'siswas.user_id') // user siswa
            ->leftJoin('ortus', 'ortus.siswa_id', '=', 'siswas.id') // tabel ortu
            ->leftJoin('users as ortu_users', 'ortu_users.id', '=', 'ortus.user_id') // user ortu
            ->when($search, function ($query, $search) {
                return $query
                    ->where('users.nama', 'like', "%{$search}%")          // nama siswa
                    ->orWhere('users.username', 'like', "%{$search}%")    // username siswa
                    ->orWhere('siswas.nisn', 'like', "%{$search}%")       // nisn siswa
                    ->orWhere('ortu_users.username', 'like', "%{$search}%"); // username orangtua
            })
            ->orderBy('users.nama')
            ->select('siswas.*')
            ->paginate(10)
            ->withQueryString();

        $result = session('import_result');

        return view('admin.siswa.index', compact('siswas', 'search', 'result'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        $result = session('import_result', [
            'total' => 0,
            'inserted' => 0,
            'skipped' => 0,
        ]);

        return redirect()->route('admin.siswa.index')->with('import_result', $result);
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
