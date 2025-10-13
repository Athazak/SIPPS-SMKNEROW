<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    use HasFactory;

    protected $fillable = ['bentuk', 'kriteria', 'skor'];

    public function catatanPenghargaans()
    {
        return $this->hasMany(CatatanPenghargaan::class, 'id_penghargaan');
    }
}
