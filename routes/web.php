<?php

use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\SiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RombelController;
use App\Http\Controllers\Admin\PelanggaranController;
use App\Http\Controllers\Admin\BentukPelanggaranController;
use App\Http\Controllers\Admin\PenangananPelanggaranController;
use App\Http\Controllers\Admin\PenghargaanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('auth.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Profile Routes (akses semua yang login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Kelola Kelas
    Route::resource('rombel', RombelController::class);

    // Import User
    Route::get('/import/guru', [GuruController::class, 'index'])->name('guru.index');
    Route::post('/import/guru', [GuruController::class, 'import'])->name('guru.import');
    
    Route::get('/import/siswa', [SiswaController::class, 'index'])->name('siswa.index');
    Route::post('/import/siswa', [SiswaController::class, 'import'])->name('siswa.import');
    
    // Jenis dan Bentuk Pelanggaran
    Route::resource('pelanggaran', PelanggaranController::class);
    Route::resource('bentuk-pelanggaran', BentukPelanggaranController::class);
    Route::resource('penanganan', PenangananPelanggaranController::class);

    // Penghargaan
    Route::resource('penghargaan', PenghargaanController::class);
});

/*
|--------------------------------------------------------------------------
| Guru Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Guru\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pelanggaran', App\Http\Controllers\Guru\PelanggaranController::class);
});

/*
|--------------------------------------------------------------------------
| Siswa Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Siswa\DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| Orang Tua Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:ortu'])->prefix('ortu')->name('ortu.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Ortu\DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__ . '/auth.php';
