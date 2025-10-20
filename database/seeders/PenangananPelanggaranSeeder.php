<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PenangananPelanggaran;

class PenangananPelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Pelanggaran Ringan
            [
                'kategori' => 'ringan',
                'skor_min' => 10,
                'skor_max' => 35,
                'tindak_lanjut' => 'Peringatan ke-1 (Wali Kelas)',
            ],
            [
                'kategori' => 'ringan',
                'skor_min' => 36,
                'skor_max' => 55,
                'tindak_lanjut' => 'Peringatan ke-2 (Wali Kelas) + BK',
            ],

            // Pelanggaran Sedang
            [
                'kategori' => 'sedang',
                'skor_min' => 56,
                'skor_max' => 75,
                'tindak_lanjut' => 'Panggilan Orang Tua ke-1 (Wali Kelas) + BK',
            ],
            [
                'kategori' => 'sedang',
                'skor_min' => 76,
                'skor_max' => 95,
                'tindak_lanjut' => 'Panggilan Orang Tua ke-2 (Guru BK)',
            ],
            [
                'kategori' => 'sedang',
                'skor_min' => 96,
                'skor_max' => 150,
                'tindak_lanjut' => 'Panggilan Orang Tua ke-3 (Guru BK)',
            ],

            // Pelanggaran Berat
            [
                'kategori' => 'berat',
                'skor_min' => 151,
                'skor_max' => 249,
                'tindak_lanjut' => 'Skorsing Wakasis + BK',
            ],
            [
                'kategori' => 'berat',
                'skor_min' => 250,
                'skor_max' => 9999, // batas atas terbuka
                'tindak_lanjut' => 'Dikembalikan ke orang tua (Kepala Sekolah + Wakasis + BK + Wali Kelas)',
            ],
        ];

        PenangananPelanggaran::insert($data);
    }
}
