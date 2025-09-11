<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenghargaanSiswa extends Model
{
    use HasFactory;
    protected $table = 'penghargaan_siswa';
    protected $fillable = ['siswa_id', 'penghargaan_id', 'tanggal', 'keterangan', 'guru_id'];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }
    public function penghargaan()
    {
        return $this->belongsTo(Penghargaan::class, 'penghargaan_id');
    }
    public function guru()
    {
        return $this->belongsTo(User::class, 'guru_id');
    }
}
