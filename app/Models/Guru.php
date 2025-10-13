<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nuptk', 'nip', 'jenis_kelamin', 'status_kepegawaian'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function catatanPelanggarans()
    {
        return $this->hasMany(CatatanPelanggaran::class, 'id_guru');
    }

    public function catatanPenghargaans()
    {
        return $this->hasMany(CatatanPenghargaan::class, 'id_guru');
    }
}
