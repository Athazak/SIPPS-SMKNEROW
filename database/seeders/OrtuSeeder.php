<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ortu;
use App\Models\User;
use App\Models\Siswa;

class OrtuSeeder extends Seeder
{
    public function run(): void
    {
        $userOrtu = User::where('role', 'ortu')->first();
        $siswa = Siswa::first();

        Ortu::create([
            'user_id' => $userOrtu->id,
            'siswa_id' => $siswa->id,
        ]);
    }
}
