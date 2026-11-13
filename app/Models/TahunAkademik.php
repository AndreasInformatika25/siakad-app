<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAkademik extends Model
{
    use HasFactory;

    // Spesifikasikan nama tabel yang benar
    protected $table = 'tahun_akademik';

    // Daftarkan kolom yang boleh diisi melalui form
    protected $fillable = [
        'tahun',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];
}