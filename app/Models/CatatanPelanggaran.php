<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CatatanPelanggaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_guru',
        'id_siswa',
        'id_pelanggaran',
        'tanggal',
        'keterangan',
        'id_penanganan',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class, 'id_pelanggaran');
    }

    public function penanganan()
    {
        return $this->belongsTo(PenangananPelanggaran::class, 'id_penanganan');
    }
}
