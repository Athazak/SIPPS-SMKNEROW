<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BentukPelanggaran extends Model
{
    use HasFactory;
    protected $fillable = ['jenis_id', 'bentuk', 'skor', 'sanksi'];

    public function jenis()
    {
        return $this->belongsTo(JenisPelanggaran::class, 'jenis_id');
    }
}
