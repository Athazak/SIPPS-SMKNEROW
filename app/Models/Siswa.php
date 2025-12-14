<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nipd', 'nisn', 'jenis_kelamin', 'rombel_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }

    public function ortu()
    {
        return $this->hasOne(Ortu::class);
    }

    public function catatanPelanggarans()
    {
        return $this->hasMany(CatatanPelanggaran::class, 'id_siswa');
    }

    public function catatanPenghargaans()
    {
        return $this->hasMany(CatatanPenghargaan::class, 'id_siswa');
    }

    public function hitungSkorAkhir()
{
    $totalPelanggaran = $this->catatanPelanggarans
        ->sum(fn($c) => $c->pelanggaran->skor ?? 0);

    $totalPenghargaan = $this->catatanPenghargaans
        ->sum(fn($c) => $c->penghargaan->skor ?? 0);

    if ($totalPelanggaran > 75) {
        $skor = $totalPelanggaran - $totalPenghargaan;
    } else {
        $skor = $totalPelanggaran;
    }

    return max(0, $skor);
}
}
