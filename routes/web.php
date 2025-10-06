<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\JenisPelanggaranController;
use App\Http\Controllers\Admin\BentukPelanggaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

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

    // Import User
    Route::get('/import', [ImportController::class, 'index'])->name('import.index');
    Route::post('/import/siswa/preview', [ImportController::class, 'previewSiswa'])->name('import.preview-siswa');
    Route::post('/import/siswa/store', [ImportController::class, 'storeSiswa'])->name('import.siswa-store');

    Route::post('/import/generate-ortu', [ImportController::class, 'generateOrtu'])->name('import.generate-ortu');

    Route::post('/import/guru/preview', [ImportController::class, 'previewGuru'])->name('import.preview-guru');
    Route::post('/import/guru/store', [ImportController::class, 'storeGuru'])->name('import.guru-store');

    // Kelola Kelas
    Route::resource('kelas', KelasController::class)->parameters([
        'kelas' => 'kelas'
    ]);
    Route::get('/kelas/get-next-number', [KelasController::class, 'getNextNumber'])
        ->name('kelas.getNextNumber');

    // Jenis dan Bentuk Pelanggaran
    Route::resource('jenis-pelanggaran', JenisPelanggaranController::class);
    Route::resource('bentuk-pelanggaran', BentukPelanggaranController::class);

    // CRUD master data (jenis pelanggaran, bentuk, penghargaan, penanganan)
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
