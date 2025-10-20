<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggaran;

class PelanggaranSeeder extends Seeder
{
    public function run(): void
    {
        // ================== A. SIKAP PERILAKU ==================
        $sikap = [
            ['bentuk' => 'Tidak membawa buku sesuai jadwal', 'skor' => 5],
            ['bentuk' => 'Membuat kegaduhan di kelas atau di sekolah', 'skor' => 10],
            ['bentuk' => 'Mencoret-coret atau mengotori dinding, pintu, meja, kursi, pagar sekolah', 'skor' => 5],
            ['bentuk' => 'Membawa atau bermain kartu remi dan domino di sekolah', 'skor' => 5],
            ['bentuk' => 'Memarkir sepeda/motor tidak pada tempatnya', 'skor' => 5],
            ['bentuk' => 'Bermain bola di koridor dan di dalam kelas', 'skor' => 5],
            ['bentuk' => 'Menyontek', 'skor' => 10],
            ['bentuk' => 'Melindungi teman yang bersalah', 'skor' => 10],
            ['bentuk' => 'Menghidupkan handphone waktu KBM', 'skor' => 10],
            ['bentuk' => 'Berpacaran di sekolah', 'skor' => 15],
            ['bentuk' => 'Berperilaku jorok atau asusila baik di dalam maupun di luar sekolah', 'skor' => 20],
            ['bentuk' => 'Merayakan ulang tahun berlebihan', 'skor' => 10],
            ['bentuk' => 'Menyalahgunakan uang sekolah', 'skor' => 25],
            ['bentuk' => 'Membawa atau membunyikan petasan', 'skor' => 25],
            ['bentuk' => 'Membuat surat izin palsu', 'skor' => 30],
            ['bentuk' => 'Meloncat jendela dan pagar sekolah', 'skor' => 25],
            ['bentuk' => 'Merusak sarana dan prasarana sekolah', 'skor' => 25],
            ['bentuk' => 'Bertindak tidak sopan/melecehkan Kepala Sekolah, guru, atau karyawan sekolah', 'skor' => 50],
            ['bentuk' => 'Mengancam/mengintimidasi teman sekelas atau teman sekolah', 'skor' => 50],
            ['bentuk' => 'Mengancam/mengintimidasi Kepala Sekolah, guru, atau karyawan', 'skor' => 100],
            ['bentuk' => 'Membawa/merokok saat masih mengenakan seragam sekolah', 'skor' => 40],
            ['bentuk' => 'Menyalahgunakan media sosial yang merugikan pihak lain yang berhubungan dengan sekolah', 'skor' => 50],
            ['bentuk' => 'Berjudi dalam bentuk apapun di sekolah', 'skor' => 100],
            ['bentuk' => 'Membawa senjata tajam/senjata api dsb di sekolah', 'skor' => 100],
            ['bentuk' => 'Terlibat langsung maupun tidak langsung perkelahian/tawuran di sekolah, di luar sekolah, atau antar sekolah', 'skor' => 100],
            ['bentuk' => 'Mengikuti aliran/perkumpulan/geng terlarang/komunitas LGBT dan radikalisme', 'skor' => 100],
            ['bentuk' => 'Membawa, menggunakan atau mengedarkan miras dan narkoba', 'skor' => 250],
            ['bentuk' => 'Membawa dan/atau membuat VCD/buku/majalah porno atau yang berbau pornografi dan pornoaksi', 'skor' => 200],
            ['bentuk' => 'Mencuri di dalam maupun di luar sekolah', 'skor' => 250],
            ['bentuk' => 'Memalsukan stempel sekolah, edaran sekolah atau tanda tangan Kepala Sekolah/guru/karyawan', 'skor' => 250],
            ['bentuk' => 'Terlibat tindakan kriminal, mencemarkan nama baik sekolah', 'skor' => 250],
            ['bentuk' => 'Terbukti hamil atau menghamili', 'skor' => 250],
            ['bentuk' => 'Terbukti menikah', 'skor' => 250],
            ['bentuk' => 'Memakai tindik dan tato', 'skor' => 50],
            ['bentuk' => 'Berkata kotor', 'skor' => 20],
        ];

        // ================== B. KERAJINAN ==================
        $kerajinan = [
            ['bentuk' => 'Datang terlambat', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti pelajaran tanpa izin', 'skor' => 10],
            ['bentuk' => 'Meninggalkan kelas tanpa izin', 'skor' => 5],
            ['bentuk' => 'Berada di kantin saat jam pelajaran', 'skor' => 5],
            ['bentuk' => 'Tidak mengikuti dan melaksanakan piket 7K', 'skor' => 10],
            ['bentuk' => 'Tidur di kelas saat pelajaran berlangsung', 'skor' => 5],
            ['bentuk' => 'Tidak membawa buku yang berkaitan dengan pelajaran', 'skor' => 5],
            ['bentuk' => 'Pulang sebelum waktunya tanpa izin dari sekolah', 'skor' => 10],
            ['bentuk' => 'Tidak masuk tanpa keterangan', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti upacara', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti kegiatan sekolah', 'skor' => 10],
            ['bentuk' => 'Tidak mengikuti kegiatan ekstrakurikuler', 'skor' => 10],
        ];

        // ================== C. KERAPIAN ==================
        $kerapian = [
            ['bentuk' => 'Tidak berseragam sesuai dengan ketentuan', 'skor' => 10],
            ['bentuk' => 'Tidak memasukkan baju', 'skor' => 5],
            ['bentuk' => 'Melipat lengan baju atau tidak dikancingkan', 'skor' => 5],
            ['bentuk' => 'Seragam yang dicoret-coret', 'skor' => 5],
            ['bentuk' => 'Celana atau rok sobek', 'skor' => 5],
            ['bentuk' => 'Tidak memakai kaos kaki', 'skor' => 5],
            ['bentuk' => 'Memakai kaos kaki tidak sesuai ketentuan', 'skor' => 5],
            ['bentuk' => 'Tidak memakai ikat pinggang', 'skor' => 5],
            ['bentuk' => 'Memakai ikat pinggang tidak sesuai ketentuan (hitam)', 'skor' => 5],
            ['bentuk' => 'Seragam atribut tidak lengkap', 'skor' => 5],
            ['bentuk' => 'Tidak memakai sepatu hitam (selain olahraga)', 'skor' => 5],
            ['bentuk' => 'Memakai make up', 'skor' => 10],
        ];

        // Insert semua ke database
        foreach ($sikap as $p) {
            Pelanggaran::create([
                'jenis_pelanggaran' => 'Sikap perilaku',
                'bentuk' => $p['bentuk'],
                'skor' => $p['skor'],
            ]);
        }

        foreach ($kerajinan as $p) {
            Pelanggaran::create([
                'jenis_pelanggaran' => 'Kerajinan',
                'bentuk' => $p['bentuk'],
                'skor' => $p['skor'],
            ]);
        }

        foreach ($kerapian as $p) {
            Pelanggaran::create([
                'jenis_pelanggaran' => 'Kerapian',
                'bentuk' => $p['bentuk'],
                'skor' => $p['skor'],
            ]);
        }
    }
}
