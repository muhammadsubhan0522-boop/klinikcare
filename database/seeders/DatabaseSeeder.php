<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Data default obat klinik
        $obats = [
            ['nama' => 'Paracetamol 500mg', 'jenis' => 'Tablet / Analgesik', 'penjelasan' => 'Meredakan demam dan nyeri ringan hingga sedang.', 'stok' => 150],
            ['nama' => 'Amoxicillin 500mg', 'jenis' => 'Kapsul / Antibiotik', 'penjelasan' => 'Antibiotik untuk mengatasi infeksi bakteri.', 'stok' => 85],
            ['nama' => 'Ibuprofen 400mg', 'jenis' => 'Tablet / NSAID', 'penjelasan' => 'Menurunkan demam dan meredakan peradangan/nyeri sendi.', 'stok' => 120],
            ['nama' => 'Omeprazole 20mg', 'jenis' => 'Kapsul / PPI', 'penjelasan' => 'Mengatasi gangguan lambung, GERD, dan asam lambung berlebih.', 'stok' => 95],
            ['nama' => 'Antasida Doen', 'jenis' => 'Tablet Kunyah / Antasid', 'penjelasan' => 'Menetralisir asam lambung untuk meredakan mual dan ulu hati.', 'stok' => 200],
            ['nama' => 'Cetirizine 10mg', 'jenis' => 'Tablet / Antihistamin', 'penjelasan' => 'Meredakan gejala alergi seperti gatal dan bersin-bersin.', 'stok' => 45],
            ['nama' => 'Vitamin C 500mg', 'jenis' => 'Tablet / Suplemen', 'penjelasan' => 'Meningkatkan daya tahan tubuh dan sebagai antioksidan.', 'stok' => 300],
            ['nama' => 'Salbutamol 4mg', 'jenis' => 'Tablet / Bronkodilator', 'penjelasan' => 'Melebarkan saluran pernapasan untuk mengatasi sesak napas.', 'stok' => 30],
        ];

        foreach ($obats as $obat) {
            Obat::create($obat);
        }
    }
}