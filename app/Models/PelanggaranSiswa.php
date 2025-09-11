<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PelanggaranSiswa extends Model
{
    use HasFactory;
    protected $table = 'pelanggaran_siswa';
    protected $fillable = ['siswa_id', 'bentuk_pelanggaran_id', 'tanggal', 'keterangan', 'guru_id'];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
    public function bentuk()
    {
        return $this->belongsTo(BentukPelanggaran::class, 'bentuk_pelanggaran_id');
    }
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
