<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'alamat',
        'nip',
        'nis',
        'kelas_id',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function pelanggaranSiswa()
    {
        return $this->hasMany(PelanggaranSiswa::class, 'siswa_id');
    }

    public function penghargaanSiswa()
    {
        return $this->hasMany(PenghargaanSiswa::class, 'siswa_id');
    }

    public function isRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->isRole('admin');
    }
    public function isGuru()
    {
        return $this->isRole('guru');
    }
    public function isSiswa()
    {
        return $this->isRole('siswa');
    }
    public function isOrtu()
    {
        return $this->isRole('ortu');
    }
}
