<?php

namespace Database\Seeders;

use App\Models\PenangananPelanggaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RombelSeeder::class,
            PelanggaranSeeder::class,
            PenghargaanSeeder::class,
            PenangananPelanggaran::class,
        ]);
    }

}
