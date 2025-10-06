<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tingkatan = [
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];

        $jurusanData = [
            'APAT' => 1,
            'DPB' => 1,
            'DKV' => 2,
            'TSM' => 2,
        ];

        foreach ($tingkatan as $angka => $romawi) {
            foreach ($jurusanData as $jurusan => $jumlahKelas) {
                for ($i = 1; $i <= $jumlahKelas; $i++) {
                    $namaKelas = ($jumlahKelas > 1)
                        ? "{$romawi} {$jurusan} {$i}"
                        : "{$romawi} {$jurusan}";

                    Kelas::create([
                        'nama_kelas' => $namaKelas,
                        'tingkat' => $romawi,
                        'jurusan' => $jurusan,
                    ]);
                }
            }
        }
    }
}
