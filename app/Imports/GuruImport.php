<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Guru;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Carbon\Carbon;

class GuruImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Skip 5 baris header pertama
        $rows = $rows->skip(5);

        $total = 0;
        $inserted = 0;
        $skipped = 0;

        foreach ($rows as $row) {

            if (!$row[1]) continue;

            $total++;

            $nama   = trim($row[1]);
            $nuptk  = trim($row[2]);
            $jk     = strtoupper(trim($row[3])) === 'P' ? 'P' : 'L';
            $tglLahir = Carbon::parse($row[5]);
            $nip    = trim($row[6]);
            $status = trim($row[7]);

            // --- CEK DUPLIKAT GURU (sama seperti siswa) ---
            $exists = Guru::where('nuptk', $nuptk)
                ->orWhere('nip', $nip)
                ->exists();

            if ($exists) {
                $skipped++;
                continue;
            }

            // --- Generate username guru = ddmmyy ---
            $username = $tglLahir->format('dmy');

            // Pastikan username unik (seperti siswa)
            $originalUsername = $username;
            $counter = 1;

            while (User::where('username', $username)->exists()) {
                $username = $originalUsername . $counter;
                $counter++;
            }

            // --- Buat akun user guru ---
            $userGuru = User::create([
                'nama' => $nama,
                'username' => strtoupper($username),
                'password' => Hash::make('123456'),
                'role' => 'guru',
            ]);

            // --- Insert ke tabel guru ---
            Guru::create([
                'user_id' => $userGuru->id,
                'nuptk' => $nuptk ?: null,
                'nip' => $nip ?: null,
                'jenis_kelamin' => $jk,
                'status_kepegawaian' => $status,
            ]);

            $inserted++;
        }

        // Simpan ke session (optional)
        session([
            'import_result' => [
                'total' => $total,
                'inserted' => $inserted,
                'skipped' => $skipped,
            ]
        ]);
    }
}
