<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangKelas extends Model
{
    use HasFactory;

    protected $table = 'ruang_kelas';

    protected $fillable = [
        'kode_ruang',
        'nama_ruang',
        'gedung',
        'kapasitas',
        'jenis_ruang',
        'status',
    ];
}