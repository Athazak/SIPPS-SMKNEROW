<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('sipps123'), // ganti segera
            'role' => 'admin',
            'phone' => '08123456789',
        ]);
        User::create([
            'name' => 'Bambang',
            'email' => 'bambang@gmail.com',
            'password' => Hash::make('sipps123'), // ganti segera
            'role' => 'guru',
            'phone' => '',
        ]);
        User::create([
            'name' => 'Aris Toteles',
            'email' => 'aris@gmail.com',
            'password' => Hash::make('sipps123'), // ganti segera
            'role' => 'siswa',
            'phone' => '',
        ]);
        User::create([
            'name' => 'Fajrin',
            'email' => 'fajrin@gmail.com',
            'password' => Hash::make('sipps123'), // ganti segera
            'role' => 'ortu',
            'phone' => '',
        ]);
    }
}
