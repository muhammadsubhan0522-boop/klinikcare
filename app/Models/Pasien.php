<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    
    // Menambahkan 'keluhan' ke dalam fillable agar data keluhan awal pasien tersimpan
    protected $fillable = [
        'nik', 
        'nama_lengkap', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'alamat', 
        'no_telepon',
        'keluhan'
    ];

    // Mengambil nilai kolom untuk nama pasien secara fleksibel
    public function getNamaPasienAttribute()
    {
        $attributes = $this->getAttributes();
        
        foreach ($attributes as $key => $value) {
            if ((str_contains(strtolower($key), 'nama') || str_contains(strtolower($key), 'name')) && !empty($value)) {
                return $value;
            }
        }

        return 'Pasien #' . $this->id;
    }

    // Mengambil nilai nomor rekam medis secara otomatis
    public function getNoRmAttribute()
    {
        $attributes = $this->getAttributes();
        
        foreach ($attributes as $key => $value) {
            if ((str_contains(strtolower($key), 'rm') || str_contains(strtolower($key), 'no') || str_contains(strtolower($key), 'kode')) && !empty($value)) {
                return $value;
            }
        }

        return '-';
    }

    public function antreans()
    {
        return $this->hasMany(Antrean::class, 'pasien_id');
    }
}