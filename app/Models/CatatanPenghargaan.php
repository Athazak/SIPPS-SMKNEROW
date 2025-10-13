<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanPenghargaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_guru',
        'id_siswa',
        'id_penghargaan',
        'tanggal',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function penghargaan()
    {
        return $this->belongsTo(Penghargaan::class, 'id_penghargaan');
    }
}
