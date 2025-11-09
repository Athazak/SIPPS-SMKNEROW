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
        $query = Siswa::with(['user', 'rombel', 'ortu.user']);

        if ($search = $request->input('search')) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            })
                ->orWhere('nisn', 'like', "%{$search}%");
        }

        $siswas = $query->latest()->paginate(10)->withQueryString();
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
