<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama_lengkap' => 'dr. Andi Pratama, Sp.PD',
                'spesialisasi' => 'Poli Penyakit Dalam',
                'no_telepon' => '081122334455',
                'jam_praktik' => '08:00 - 14:00',
            ],
            [
                'nama_lengkap' => 'drg. Sarah Melati',
                'spesialisasi' => 'Poli Gigi & Mulut',
                'no_telepon' => '081233445566',
                'jam_praktik' => '09:00 - 15:00',
            ],
            [
                'nama_lengkap' => 'dr. Rahmat Hidayat, Sp.A',
                'spesialisasi' => 'Poli Kesehatan Anak',
                'no_telepon' => '081344556677',
                'jam_praktik' => '13:00 - 19:00',
            ],
            [
                'nama_lengkap' => 'dr. Maya Lestari, Sp.OG',
                'spesialisasi' => 'Poli Kandungan & Kebidanan',
                'no_telepon' => '081455667788',
                'jam_praktik' => '08:00 - 13:00',
            ],
            [
                'nama_lengkap' => 'dr. Budi Santoso, Sp.KFR',
                'spesialisasi' => 'Poli Umum',
                'no_telepon' => '081566778899',
                'jam_praktik' => '15:00 - 21:00',
            ],
        ];

        foreach ($data as $item) {
            Dokter::firstOrCreate(['nama_lengkap' => $item['nama_lengkap']], $item);
        }
    }
}