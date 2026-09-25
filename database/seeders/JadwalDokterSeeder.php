<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JadwalDokter;
use App\Models\Dokter;

class JadwalDokterSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = Dokter::all();

        if ($dokters->count() > 0) {
            $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
            $poliList = ['Poli Umum', 'Poli Penyakit Dalam', 'Poli Gigi & Mulut', 'Poli Kesehatan Anak', 'Poli Kandungan'];

            foreach ($dokters as $index => $dokter) {
                JadwalDokter::firstOrCreate([
                    'dokter_id' => $dokter->id,
                    'hari' => $hariList[$index % count($hariList)],
                ], [
                    'poliklinik' => $poliList[$index % count($poliList)],
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '14:00',
                ]);
            }
        }
    }
}