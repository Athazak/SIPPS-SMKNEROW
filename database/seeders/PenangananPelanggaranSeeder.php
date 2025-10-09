<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenangananPelanggaran;

class PenangananPelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['kategori' => 'Pelanggaran Ringan', 'skor_min' => 10, 'skor_maks' => 35, 'tindak_lanjut' => 'Peringatan ke-1 (Wali Kelas)'],
            ['kategori' => 'Pelanggaran Ringan', 'skor_min' => 36, 'skor_maks' => 55, 'tindak_lanjut' => 'Peringatan ke-2 (Wali Kelas) + BK'],
            ['kategori' => 'Pelanggaran Sedang', 'skor_min' => 56, 'skor_maks' => 75, 'tindak_lanjut' => 'Panggilan Orang Tua ke-1 (Wali Kelas) + BK'],
            ['kategori' => 'Pelanggaran Sedang', 'skor_min' => 76, 'skor_maks' => 95, 'tindak_lanjut' => 'Panggilan Orang Tua ke-2 (Guru BK)'],
            ['kategori' => 'Pelanggaran Sedang', 'skor_min' => 96, 'skor_maks' => 150, 'tindak_lanjut' => 'Panggilan Orang Tua ke-3 (Guru BK)'],
            ['kategori' => 'Pelanggaran Berat', 'skor_min' => 151, 'skor_maks' => 249, 'tindak_lanjut' => 'Skorsing Wakasik + BK'],
            ['kategori' => 'Pelanggaran Berat', 'skor_min' => 250, 'skor_maks' => null, 'tindak_lanjut' => 'Dikembalikan ke Orang Tua (Kepala Sekolah + Wakasik + BK + Wali Kelas)'],
        ];

        PenangananPelanggaran::insert($data);
    }
}
