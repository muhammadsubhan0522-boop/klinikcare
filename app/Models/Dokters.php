<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters'; // Sesuaikan jika nama tabel beda
    
    protected $fillable = [
        'nama_lengkap',
        'spesialisasi',
        'no_telepon',
        'jam_praktik'
    ];
}