<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KelasSeeder::class,
            AdminSeeder::class,
            JenisPelanggaranSeeder::class,
            BentukPelanggaranSeeder::class,
            PenghargaanSeeder::class,
            PenangananPelanggaranSeeder::class,
        ]);
    }

}
