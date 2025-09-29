<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $kelas = Kelas::firstOrCreate(['nama_kelas' => $row['kelas']]);

        return new User([
            'name'     => $row['nama'],
            'email'    => $row['email'] ?? null,
            'password' => Hash::make('password123'),
            'role'     => 'siswa',
            'nis'      => $row['nis'] ?? null,
            'kelas_id' => $kelas->id,
            'status'   => 'aktif',
        ]);
    }
}
