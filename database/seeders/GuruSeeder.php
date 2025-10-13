<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\User;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $userGuru = User::where('role', 'guru')->first();

        Guru::create([
            'user_id' => $userGuru->id,
            'nuptk' => '1234567890',
            'nip' => '197800112020111001',
            'jenis_kelamin' => 'L',
            'status_kepegawaian' => 'PNS',
        ]);
    }
}
