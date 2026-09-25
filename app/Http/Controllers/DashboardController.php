<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Antrean;
use App\Models\Pemeriksaan;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. AMBIL DATA DOKTER DARI DATABASE ATAU GUNAKAN CADANGAN (FALLBACK)
        try {
            $dokter_db = Dokter::latest()->take(4)->get();
        } catch (\Exception $e) {
            $dokter_db = collect();
        }
        
        $dokter_aktif = [];
        foreach($dokter_db as $d) {
            $dokter_aktif[] = [
                'id' => 'D-0' . $d->id,
                'nama' => $d->nama_lengkap ?? $d->nama ?? 'Dokter',
                'poli' => $d->spesialis ?? $d->spesialisasi ?? 'Umum',
                'status' => 'Praktik'
            ];
        }

        // Jika database dokter masih kosong, pakai data bawaan agar tampilan tetap bagus
        if(empty($dokter_aktif)) {
            $dokter_aktif = [
                ['id' => 'D-01', 'nama' => 'dr. Andi Pratama, Sp.A', 'poli' => 'Poli Anak', 'status' => 'Praktik'],
                ['id' => 'D-02', 'nama' => 'dr. Rina Kusuma, Sp.OG', 'poli' => 'Poli Kandungan', 'status' => 'Praktik'],
                ['id' => 'D-03', 'nama' => 'dr. Budi Santoso, Sp.PD', 'poli' => 'Poli Umum', 'status' => 'Istirahat'],
                ['id' => 'D-04', 'nama' => 'drg. Maya Sari', 'poli' => 'Poli Gigi', 'status' => 'Praktik'],
            ];
        }

        // 2. DATA PENDUKUNG CADANGAN ANTREAN & PEMERIKSAAN
        $antrean_terbaru = [
            ['no' => 'A-023', 'pasien' => 'Ahmad Fauzi', 'dokter' => 'dr. Andi Pratama, Sp.A', 'status' => 'Menunggu'],
            ['no' => 'A-024', 'pasien' => 'Siti Nurhaliza', 'dokter' => 'dr. Andi Pratama, Sp.A', 'status' => 'Dipanggil'],
            ['no' => 'A-025', 'pasien' => 'Rizky Ramadhan', 'dokter' => 'dr. Rina Kusuma, Sp.OG', 'status' => 'Menunggu'],
            ['no' => 'A-026', 'pasien' => 'Dewi Lestari', 'dokter' => 'drg. Maya Sari', 'status' => 'Menunggu'],
        ];

        $pemeriksaan_hari_ini = [
            ['id' => 'RM-2026-001', 'pasien' => 'Ahmad Fauzi', 'keluhan' => 'Demam & Flu Berdarah', 'diagnosa' => 'ISPA', 'status' => 'Selesai'],
            ['id' => 'RM-2026-002', 'pasien' => 'Siti Nurhaliza', 'keluhan' => 'Sakit Kepala Migrain', 'diagnosa' => 'Tension Headache', 'status' => 'Pemeriksaan'],
            ['id' => 'RM-2026-003', 'pasien' => 'Budi Santoso', 'keluhan' => 'Nyeri Lambung', 'diagnosa' => 'Dispepsia / Gastritis', 'status' => 'Selesai'],
        ];

        // 3. HITUNG STATISTIK OTOMATIS DARI DATABASE DENGAN PENGAMAN TRY-CATCH
        try {
            $totalPasien = Pasien::count();
        } catch (\Exception $e) {
            $totalPasien = 0;
        }

        try {
            $totalDokter = Dokter::count();
        } catch (\Exception $e) {
            $totalDokter = count($dokter_aktif);
        }

        try {
            $totalAntrean = Antrean::count();
        } catch (\Exception $e) {
            $totalAntrean = count($antrean_terbaru);
        }

        try {
            $totalPemeriksaan = Pemeriksaan::count();
        } catch (\Exception $e) {
            $totalPemeriksaan = count($pemeriksaan_hari_ini);
        }

        // 4. AMBIL DATA ANTREAN AKTIF TERBARU DARI RELASI DATABASE SECARA REAL-TIME
        try {
            $antreansAktif = Antrean::with(['pasien', 'dokter'])->latest()->take(3)->get();
        } catch (\Exception $e) {
            $antreansAktif = collect();
        }

        // Variabel array statistik untuk kompatibilitas tambahan
        $statistik = [
            'total_pasien' => $totalPasien,
            'total_dokter' => $totalDokter,
            'antrean_hari_ini' => $totalAntrean,
            'pemeriksaan_hari_ini' => $totalPemeriksaan,
        ];

        // 5. KIRIM SELURUH DATA KE VIEW TANPA ADA YANG TERLEWAT
        return view('dashboard.index', compact(
            'totalPasien', 
            'totalDokter', 
            'totalAntrean', 
            'totalPemeriksaan',
            'antreansAktif',
            'statistik',
            'dokter_aktif',
            'antrean_terbaru',
            'pemeriksaan_hari_ini'
        ));
    }
}