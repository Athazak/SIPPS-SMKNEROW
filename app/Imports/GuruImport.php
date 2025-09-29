<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GuruImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'     => $row['nama'],
            'email'    => $row['email'] ?? null,
            'password' => Hash::make('password123'),
            'role'     => 'guru',
            'nip'      => $row['nip'] ?? null,
            'phone'    => $row['phone'] ?? null,
            'status'   => 'aktif',
        ]);
    }
}
