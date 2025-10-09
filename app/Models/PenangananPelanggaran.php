<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenangananPelanggaran extends Model
{
    use HasFactory;
    protected $fillable = ['kategori', 'skor_min', 'skor_max', 'tindak_lanjut'];
}
