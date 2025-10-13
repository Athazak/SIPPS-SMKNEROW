<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'nama' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('sipps123'),
            'role' => 'admin'
        ]);

        // // Guru
        // User::create([
        //     'name' => 'Bapak Guru',
        //     'username' => 'guru1',
        //     'password' => Hash::make('123456'),
        //     'role' => 'guru'
        // ]);

        // // Siswa
        // User::create([
        //     'name' => 'Siswa Pertama',
        //     'username' => 'siswa1',
        //     'password' => Hash::make('123456'),
        //     'role' => 'siswa'
        // ]);

        // // Orang Tua
        // User::create([
        //     'name' => 'Orang Tua Siswa Pertama',
        //     'username' => 'ortu1',
        //     'password' => Hash::make('123456'),
        //     'role' => 'ortu'
        // ]);
    }
}
