<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Rombel;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $userSiswa = User::where('role', 'siswa')->first();
        $rombel = Rombel::first();

        Siswa::create([
            'user_id' => $userSiswa->id,
            'nipd' => '10001',
            'nisn' => '2025010101',
            'jenis_kelamin' => 'L',
            'rombel_id' => $rombel->id,
        ]);
    }
}
