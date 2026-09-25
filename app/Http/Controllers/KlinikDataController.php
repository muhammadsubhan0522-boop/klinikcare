<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KlinikDataController extends Controller
{
    // Data Master yang Sinkron untuk Seluruh Fitur
    public static getMasterData()
    {
        $pasien = [
            ['id' => 'P-001', 'nama' => 'Ahmad Fauzi', 'gender' => 'Laki-laki', 'telp' => '081234567890', 'alamat' => 'Bireuen'],
            ['id' => 'P-002', 'nama' => 'Siti Nurhaliza', 'gender' => 'Perempuan', 'telp' => '081298765432', 'alamat' => 'Lhokseumawe'],
            ['id' => 'P-003', 'nama' => 'Budi Santoso', 'gender' => 'Laki-laki', 'telp' => '081345678912', 'alamat' => 'Banda Aceh'],
            ['id' => 'P-004', 'nama' => 'Rizky Ramadhan', 'gender' => 'Laki-laki', 'telp' => '081122334455', 'alamat' => 'Pidie'],
            ['id' => 'P-005', 'nama' => 'Dewi Lestari', 'gender' => 'Perempuan', 'telp' => '082233445566', 'alamat' => 'Aceh Utara'],
        ];

        $dokter = [
            ['id' => 'D-01', 'nama' => 'dr. Andi Pratama, Sp.A', 'poli' => 'Poli Anak', 'status' => 'Praktik'],
            ['id' => 'D-02', 'nama' => 'dr. Rina Kusuma, Sp.OG', 'poli' => 'Poli Kandungan', 'status' => 'Praktik'],
            ['id' => 'D-03', 'nama' => 'dr. Budi Santoso, Sp.PD', 'poli' => 'Poli Umum', 'status' => 'Istirahat'],
            ['id' => 'D-04', 'nama' => 'drg. Maya Sari', 'poli' => 'Poli Gigi', 'status' => 'Praktik'],
        ];

        $antrean = [
            ['no' => 'A-023', 'pasien' => 'Ahmad Fauzi', 'dokter' => 'dr. Andi Pratama, Sp.A', 'status' => 'Menunggu'],
            ['no' => 'A-024', 'pasien' => 'Siti Nurhaliza', 'dokter' => 'dr. Andi Pratama, Sp.A', 'status' => 'Dipanggil'],
            ['no' => 'A-025', 'pasien' => 'Rizky Ramadhan', 'dokter' => 'dr. Rina Kusuma, Sp.OG', 'status' => 'Menunggu'],
            ['no' => 'A-026', 'pasien' => 'Dewi Lestari', 'dokter' => 'drg. Maya Sari', 'status' => 'Menunggu'],
        ];

        $pemeriksaan = [
            ['id' => 'RM-2026-001', 'pasien' => 'Ahmad Fauzi', 'keluhan' => 'Demam & Flu', 'diagnosa' => 'ISPA', 'status' => 'Selesai'],
            ['id' => 'RM-2026-002', 'pasien' => 'Siti Nurhaliza', 'keluhan' => 'Sakit Kepala', 'diagnosa' => 'Migrain', 'status' => 'Pemeriksaan'],
            ['id' => 'RM-2026-003', 'pasien' => 'Budi Santoso', 'keluhan' => 'Nyeri Lambung', 'diagnosa' => 'Gastritis', 'status' => 'Selesai'],
        ];

        return compact('pasien', 'dokter', 'antrean', 'pemeriksaan');
    }
}