<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pasien;

class PasienSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nik' => '31710101010001',
                'nama_lengkap' => 'Ahmad Fauzi',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1995-05-12',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Merdeka No. 10, Banda Aceh',
                'no_telepon' => '081234567890',
            ],
            [
                'nik' => '31710101010002',
                'nama_lengkap' => 'Siti Nurhaliza',
                'tempat_lahir' => 'Banda Aceh',
                'tanggal_lahir' => '1998-08-20',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Teuku Umar No. 45',
                'no_telepon' => '081398765432',
            ],
            [
                'nik' => '31710101010003',
                'nama_lengkap' => 'Budi Santoso',
                'tempat_lahir' => 'Medan',
                'tanggal_lahir' => '1990-12-05',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Iskandar Muda No. 12',
                'no_telepon' => '082112233445',
            ],
        ];

        foreach ($data as $item) {
            Pasien::firstOrCreate(['nik' => $item['nik']], $item);
        }
    }
}