<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BentukPelanggaran;
use App\Models\JenisPelanggaran;

class BentukPelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        $jenis = JenisPelanggaran::pluck('id', 'nama_jenis');

        // ====== A. SIKAP DAN PERILAKU ======
        $sikap = [
            ['bentuk' => 'Tidak membawa buku sesuai jadwal', 'skor' => 5],
            ['bentuk' => 'Membuat kegaduhan di kelas atau di sekolah', 'skor' => 10],
            ['bentuk' => 'Mencoret-coret atau mengotori fasilitas sekolah', 'skor' => 5],
            ['bentuk' => 'Membawa atau bermain kartu remi/domino di sekolah', 'skor' => 5],
            ['bentuk' => 'Memarkir sepeda/motor tidak pada tempatnya', 'skor' => 5],
            ['bentuk' => 'Bermain bola di koridor/dalam kelas', 'skor' => 5],
            ['bentuk' => 'Menyontek', 'skor' => 10],
            ['bentuk' => 'Melindungi teman yang bersalah', 'skor' => 10],
            ['bentuk' => 'Menghidupkan handphone saat KBM', 'skor' => 10],
            ['bentuk' => 'Berpacaran di sekolah', 'skor' => 15],
            ['bentuk' => 'Berperilaku jorok atau asusila', 'skor' => 20],
            ['bentuk' => 'Merayakan ulang tahun berlebihan', 'skor' => 10],
            ['bentuk' => 'Menyalahgunakan uang sekolah', 'skor' => 25],
            ['bentuk' => 'Membawa atau membunyikan petasan', 'skor' => 25],
            ['bentuk' => 'Membuat surat izin palsu', 'skor' => 30],
            ['bentuk' => 'Meloncat jendela atau pagar sekolah', 'skor' => 25],
            ['bentuk' => 'Merusak sarana dan prasarana sekolah', 'skor' => 25],
            ['bentuk' => 'Bertindak tidak sopan/melecehkan guru/karyawan', 'skor' => 50],
            ['bentuk' => 'Mengancam atau mengintimidasi teman', 'skor' => 50],
            ['bentuk' => 'Mengancam Kepala Sekolah/guru/karyawan', 'skor' => 100],
            ['bentuk' => 'Merokok saat mengenakan seragam sekolah', 'skor' => 40],
            ['bentuk' => 'Menyalahgunakan media sosial yang merugikan sekolah', 'skor' => 50],
            ['bentuk' => 'Berjudi dalam bentuk apapun di sekolah', 'skor' => 100],
            ['bentuk' => 'Membawa senjata tajam/senjata api', 'skor' => 100],
            ['bentuk' => 'Terlibat perkelahian/tawuran', 'skor' => 100],
            ['bentuk' => 'Mengikuti geng terlarang/komunitas radikal/LGBT', 'skor' => 100],
            ['bentuk' => 'Membawa/menggunakan/mengedarkan miras atau narkoba', 'skor' => 250],
            ['bentuk' => 'Membawa/membuat VCD/buku porno', 'skor' => 200],
            ['bentuk' => 'Mencuri di dalam atau luar sekolah', 'skor' => 250],
            ['bentuk' => 'Memalsukan stempel/tanda tangan sekolah', 'skor' => 250],
            ['bentuk' => 'Terlibat tindakan kriminal', 'skor' => 250],
            ['bentuk' => 'Terbukti hamil atau menghamili', 'skor' => 250],
            ['bentuk' => 'Terbukti menikah', 'skor' => 250],
            ['bentuk' => 'Memakai tindik atau tato', 'skor' => 50],
            ['bentuk' => 'Berkata kotor', 'skor' => 20],
        ];

        // ====== B. KERAJINAN ======
        $kerajinan = [
            ['bentuk' => 'Datang terlambat', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti pelajaran tanpa izin', 'skor' => 10],
            ['bentuk' => 'Meninggalkan kelas tanpa izin', 'skor' => 5],
            ['bentuk' => 'Berkeliaran di kantin saat jam pelajaran', 'skor' => 5],
            ['bentuk' => 'Tidak melaksanakan piket 7K', 'skor' => 10],
            ['bentuk' => 'Tidur di kelas saat pelajaran', 'skor' => 5],
            ['bentuk' => 'Tidak membawa buku pelajaran', 'skor' => 5],
            ['bentuk' => 'Pulang sebelum waktunya tanpa izin', 'skor' => 10],
            ['bentuk' => 'Tidak masuk tanpa keterangan', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti upacara', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti kegiatan sekolah', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti kegiatan ekstrakurikuler', 'skor' => 10],
        ];

        // ====== C. KERAPIAN ======
        $kerapian = [
            ['bentuk' => 'Tidak berseragam sesuai ketentuan', 'skor' => 10],
            ['bentuk' => 'Tidak memasukkan baju', 'skor' => 5],
            ['bentuk' => 'Melipat lengan baju/tidak dikancingkan', 'skor' => 5],
            ['bentuk' => 'Seragam dicoret-coret', 'skor' => 5],
            ['bentuk' => 'Celana atau rok sobek', 'skor' => 5],
            ['bentuk' => 'Tidak memakai kaos kaki', 'skor' => 5],
            ['bentuk' => 'Kaos kaki tidak sesuai ketentuan', 'skor' => 5],
            ['bentuk' => 'Tidak memakai ikat pinggang', 'skor' => 5],
            ['bentuk' => 'Ikat pinggang tidak sesuai ketentuan', 'skor' => 5],
            ['bentuk' => 'Atribut seragam tidak lengkap', 'skor' => 5],
            ['bentuk' => 'Tidak memakai sepatu hitam (selain olahraga)', 'skor' => 5],
            ['bentuk' => 'Memakai make up', 'skor' => 10],
        ];

        // Simpan ke database
        foreach ($sikap as $item) {
            BentukPelanggaran::create(array_merge($item, ['jenis_id' => $jenis['Sikap Perilaku']]));
        }
        foreach ($kerajinan as $item) {
            BentukPelanggaran::create(array_merge($item, ['jenis_id' => $jenis['Kerajinan']]));
        }
        foreach ($kerapian as $item) {
            BentukPelanggaran::create(array_merge($item, ['jenis_id' => $jenis['Kerapian']]));
        }
    }
}
