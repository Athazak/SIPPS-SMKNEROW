<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    protected $fillable = ['jenis_pelanggaran', 'bentuk', 'skor'];

    public function catatanPelanggarans()
    {
        return $this->hasMany(CatatanPelanggaran::class, 'id_pelanggaran');
    }
}
