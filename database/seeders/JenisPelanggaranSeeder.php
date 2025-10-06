<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisPelanggaran;

class JenisPelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $jenis = [
            ['nama_jenis' => 'Sikap Perilaku'],
            ['nama_jenis' => 'Kerajinan'],
            ['nama_jenis' => 'Kerapian'],
        ];

        JenisPelanggaran::insert($jenis);
    }
}
