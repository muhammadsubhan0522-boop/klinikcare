<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Data rekapitulasi laporan klinik sementara
        $statistik = [
            'total_pasien' => 128,
            'total_pendapatan' => 19200000,
            'total_pemeriksaan' => 94
        ];

        $riwayat_transaksi = [
            ['id' => 'TRX-2026-001', 'tanggal' => '2026-09-20', 'pasien' => 'Budi Santoso', 'layanan' => 'Poli Umum', 'total' => 150000, 'status' => 'Lunas'],
            ['id' => 'TRX-2026-002', 'tanggal' => '2026-09-19', 'pasien' => 'Siti Aminah', 'layanan' => 'Poli Gigi', 'total' => 250000, 'status' => 'Lunas'],
            ['id' => 'TRX-2026-003', 'tanggal' => '2026-09-19', 'pasien' => 'Ahmad Fauzi', 'layanan' => 'Poli Anak', 'total' => 120000, 'status' => 'Lunas'],
        ];

        return view('laporan.index', compact('statistik', 'riwayat_transaksi'));
    }
}