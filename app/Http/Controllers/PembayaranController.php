<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        // Ambil data transaksi dari session jika ada, atau default
        $tagihan = session('riwayat_transaksi', [
            'id' => 'TRX-2026-001',
            'nama_pasien' => 'Budi Santoso',
            'poli' => 'Poli Umum',
            'total' => 150000,
            'metode' => 'Belum Dipilih',
            'status' => 'Menunggu Pembayaran',
            'badge' => 'PENDING'
        ]);

        return view('pembayaran.index', compact('tagihan'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'metode' => 'required|string',
        ]);

        $metode = $request->metode;
        
        // Jika pilih transfer bank, gabungkan dengan nama bank tujuannya
        if ($metode === 'Transfer Bank') {
            $bank = $request->bank_tujuan ?? 'BCA';
            $metode = 'Transfer Bank (' . $bank . ')';
        }

        // Jika BPJS, total tagihan 0
        $total = $metode === 'BPJS Kesehatan' ? 0 : 150000;

        // Simpan data transaksi baru ke session
        $transaksiBaru = [
            'id' => 'TRX-2026-001',
            'nama_pasien' => 'Budi Santoso',
            'poli' => 'Poli Umum',
            'total' => $total,
            'metode' => $metode,
            'status' => 'Pembayaran Berhasil (Lunas)',
            'badge' => 'SUCCESS',
            'tanggal' => date('d-m-Y H:i')
        ];

        session(['riwayat_transaksi' => $transaksiBaru]);

        // Kembalikan ke halaman kasir dengan data session untuk memicu tampilan Lunas / Struk
        return redirect()->route('pembayaran.index')->with([
            'success' => 'Pembayaran berhasil diproses dengan metode ' . $metode . ' dan dinyatakan LUNAS!',
            'status_lunas' => true,
            'metode_terpilih' => $metode,
            'total_bayar' => $total
        ]);
    }
}