<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Ortu;
use App\Models\Rombel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class SiswaImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Lewati 6 baris pertama (header dan info sekolah)
        $rows = $rows->skip(6);

        foreach ($rows as $row) {
            if (!$row[1]) {
                continue; // Lewati baris kosong
            }

            $nama = trim($row[1]);
            $nipd = $row[2];
            $nisn = $row[4];
            $jk = strtoupper(trim($row[3])) === 'P' ? 'P' : 'L';
            $rombelNama = trim($row[6]);
            $tglLahir = Carbon::parse($row[7]);

            // --- Normalisasi nama rombel dari Excel agar cocok dengan DB ---
            $rombelFormatted = str_replace('-', ' ', $rombelNama);
            $rombelFormatted = preg_replace('/([A-Z]+)(\d+)/', '$1 $2', $rombelFormatted);
            $rombel = Rombel::where('nama_rombel', $rombelFormatted)->first();

            // --- Generate username siswa ---
            $namaParts = explode(' ', $nama);
            $inisial = '';

            for ($i = 0; $i < min(3, count($namaParts)); $i++) {
                $inisial .= strtolower(substr($namaParts[$i], 0, 1));
            }

            if (strlen($inisial) < 3) {
                $inisial = strtolower(substr(str_replace(' ', '', $nama), 0, 3));
            }

            // username siswa = inisial + ddmmyy
            $usernameSiswa = $inisial . $tglLahir->format('dmy');

            // Pastikan username unik
            $originalUsername = $usernameSiswa;
            $counter = 1;
            while (User::where('username', $usernameSiswa)->exists()) {
                $usernameSiswa = $originalUsername . $counter;
                $counter++;
            }

            // --- Buat akun siswa ---
            $userSiswa = User::create([
                'nama' => $nama,
                'username' => strtoupper($usernameSiswa),
                'password' => Hash::make('123456'),
                'role' => 'siswa',
            ]);

            // --- Simpan ke tabel siswa ---
            $siswa = Siswa::create([
                'user_id' => $userSiswa->id,
                'nipd' => $nipd,
                'nisn' => $nisn ?: null,
                'jenis_kelamin' => $jk,
                'rombel_id' => $rombel ? $rombel->id : null,
            ]);

            // --- Generate akun orang tua otomatis ---
            $usernameOrtu = 'O' . strtoupper($usernameSiswa);
            $originalOrtuUsername = $usernameOrtu;
            $counterOrtu = 1;

            while (User::where('username', $usernameOrtu)->exists()) {
                $usernameOrtu = $originalOrtuUsername . $counterOrtu;
                $counterOrtu++;
            }

            $userOrtu = User::create([
                'nama' => 'Ortu ' . $nama,
                'username' => $usernameOrtu,
                'password' => Hash::make('123456'),
                'role' => 'ortu',
            ]);

            // --- Simpan relasi ortu-siswa ---
            Ortu::create([
                'user_id' => $userOrtu->id,
                'siswa_id' => $siswa->id,
            ]);
        }
    }
}
