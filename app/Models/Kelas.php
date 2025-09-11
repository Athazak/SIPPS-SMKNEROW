<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['nama_kelas', 'tingkat', 'jurusan'];

    public function siswa()
    {
        return $this->hasMany(User::class, 'kelas_id')->where('role', 'siswa');
    }
}
