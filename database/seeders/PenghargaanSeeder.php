<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penghargaan;

class PenghargaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Tingkat Nasional', 'skor' => 100],
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Tingkat Provinsi', 'skor' => 75],
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Tingkat Kabupaten', 'skor' => 50],
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Tingkat Kecamatan', 'skor' => 25],
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Mengikuti lomba sebagai peserta', 'skor' => 10],
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Mengikuti LDK', 'skor' => 15],
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Diangkat menjadi ketua OSIS', 'skor' => 25],
            ['bentuk' => 'Berprestasi Akademik & Non Akademik', 'kriteria' => 'Diangkat menjadi pengurus OSIS', 'skor' => 20],
            ['bentuk' => 'Tidak Berprestasi Akademik & Non Akademik', 'kriteria' => 'Tidak pernah alpa (bagi siswa yang tidak memiliki catatan pelanggaran)', 'skor' => 25],
            ['bentuk' => 'Tidak Berprestasi Akademik & Non Akademik', 'kriteria' => 'Tidak pernah terlambat selama 1 bulan berturut-turut', 'skor' => 15],
            ['bentuk' => 'Tidak Berprestasi Akademik & Non Akademik', 'kriteria' => 'Mampu menunjukkan catatan pelajaran lengkap dengan batas waktu yang ditentukan', 'skor' => 30],
        ];

        Penghargaan::insert($data);
    }
}
