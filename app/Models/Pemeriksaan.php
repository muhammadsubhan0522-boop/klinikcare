<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika diperlukan
    protected $table = 'pemeriksaans';

    // Izinkan semua kolom diisi secara massal
    protected $guarded = ['id'];

    /**
     * Relasi ke Tabel Antrean
     */
    public function antrean()
    {
        return $this->belongsTo(Antrean::class, 'antrean_id');
    }

    /**
     * Relasi ke Tabel Pasien
     */
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id');
    }

    /**
     * Relasi ke Tabel Dokter (Diperbaiki dari Dokters ke Dokter)
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }
}