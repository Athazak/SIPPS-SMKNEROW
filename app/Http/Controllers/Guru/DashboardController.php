<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\PelanggaranSiswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $pelanggaranSaya = PelanggaranSiswa::where('guru_id', Auth::id())->count();
        return view('guru.dashboard.index', compact('pelanggaranSaya'));
    }
}
