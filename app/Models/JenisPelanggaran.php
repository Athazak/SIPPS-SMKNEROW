<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPelanggaran extends Model
{
    use HasFactory;
    protected $fillable = ['nama_jenis'];

    public function bentuk()
    {
        return $this->hasMany(BentukPelanggaran::class, 'jenis_id');
    }
}
