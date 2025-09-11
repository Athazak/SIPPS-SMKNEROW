<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penghargaan extends Model
{
    use HasFactory;
    protected $fillable = ['kategori', 'bentuk', 'kriteria', 'skor'];
}
