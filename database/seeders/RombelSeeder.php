<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rombel;

class RombelSeeder extends Seeder
{
    public function run(): void
    {
        $tingkatMap = [
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $jurusanKelas = [
            'APAT' => 1,
            'DPB' => 1,
            'DKV' => 2,
            'TSM' => 2,
        ];

        foreach ($tingkatMap as $angka => $romawi) {
            foreach ($jurusanKelas as $jurusan => $jumlahKelas) {
                if ($jumlahKelas === 1) {
                    Rombel::create([
                        'tingkat' => $romawi,
                        'jurusan' => $jurusan,
                        'nama_rombel' => "{$romawi} {$jurusan}",
                    ]);
                } else {
                    for ($i = 1; $i <= $jumlahKelas; $i++) {
                        Rombel::create([
                            'tingkat' => $romawi,
                            'jurusan' => $jurusan,
                            'nama_rombel' => "{$romawi} {$jurusan} {$i}",
                        ]);
                    }
                }
            }
        }
    }
}
