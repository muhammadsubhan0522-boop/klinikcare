@extends('layouts.app')

@section('title', 'Laporan Klinik')
@section('header-title', 'Laporan & Statistik Klinik')

@section('content')
<!-- Tambahan CSS Khusus Print agar Sidebar & Header Utama Hilang Total saat Dicetak -->
<style>
    @media print {
        /* Sembunyikan sidebar, header atas, dan tombol aksi */
        aside, nav, header, footer, .print\:hidden {
            display: none !important;
        }
        /* Buat konten laporan memenuhi halaman cetak */
        main, .container, body {
            background: white !important;
            color: black !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        /* Pastikan elemen cetak muncul sempurna */
        .hidden-print-reset {
            display: block !important;
        }
    }
</style>

<div class="space-y-6">
    
    <!-- Bagian Statistik yang disembunyikan saat dicetak -->
    <div class="print:hidden space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Pasien Terdaftar</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $statistik['total_pasien'] }} Orang</h3>
                </div>
                <span class="text-3xl bg-sky-50 p-3 rounded-xl">👥</span>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Pendapatan Bulan Ini</p>
                    <h3 class="text-2xl font-bold text-emerald-600 mt-1">Rp {{ number_format($statistik['total_pendapatan'], 0, ',', '.') }}</h3>
                </div>
                <span class="text-3xl bg-emerald-50 p-3 rounded-xl">💰</span>
            </div>
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-xs flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Total Pemeriksaan Medis</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $statistik['total_pemeriksaan'] }} Sesi</h3>
                </div>
                <span class="text-3xl bg-amber-50 p-3 rounded-xl">🩺</span>
            </div>
        </div>
    </div>

    <!-- KOP SURAT RESMI KLINIK (Hanya Muncul Saat Diprint) -->
    <div class="hidden hidden-print-reset text-center space-y-1 mb-6 border-b-2 border-slate-800 pb-4">
        <h1 class="text-xl font-black uppercase tracking-wider text-slate-900">KLINIK KESEHATAN KLINIKCARE</h1>
        <p class="text-xs text-slate-600">Jl. Kesehatan No. 124, Telp: (0651) 123456 • Email: support@klinikcare.com</p>
        <h2 class="text-sm font-bold uppercase text-slate-800 pt-2">LAPORAN RESMI KEUANGAN & TRANSAKSI KLINIK</h2>
        <p class="text-[10px] text-slate-500">Dicetak pada: {{ date('d F Y, H:i') }} WIB | Oleh: Administrator</p>
    </div>

    <!-- Tabel Riwayat Transaksi / Laporan Keuangan -->
    <div class="bg-white rounded-xl shadow-xs border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center print:hidden">
            <h3 class="text-base font-bold text-gray-800">Riwayat Transaksi & Pendapatan Klinik</h3>
            <button onclick="window.print()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-xs font-semibold transition flex items-center space-x-1 shadow-md shadow-purple-500/25">
                <span>🖨️ Cetak Laporan Resmi</span>
            </button>
        </div>
        
        <div class="overflow-x-auto p-4 print:p-0">
            <table class="w-full text-left border-collapse print:text-xs">
                <thead>
                    <tr class="bg-gray-50 print:bg-slate-100 border-b border-gray-200 text-xs text-gray-600 uppercase">
                        <th class="p-3 border print:border-slate-300">ID Transaksi</th>
                        <th class="p-3 border print:border-slate-300">Tanggal</th>
                        <th class="p-3 border print:border-slate-300">Nama Pasien</th>
                        <th class="p-3 border print:border-slate-300">Layanan / Poli</th>
                        <th class="p-3 border print:border-slate-300">Total Biaya</th>
                        <th class="p-3 border print:border-slate-300">Status</th>
                    </tr>
                </thead>
                <tbody class="text-sm print:text-xs divide-y divide-gray-100">
                    
                    <!-- Integrasi Data Transaksi Terbaru dari Sesi Kasir -->
                    @php
                        $transaksiTerakhir = session('riwayat_transaksi');
                    @endphp

                    @if($transaksiTerakhir)
                    <tr class="bg-purple-50/40 print:bg-white">
                        <td class="p-3 border print:border-slate-300 font-mono font-bold text-purple-600 print:text-black">{{ $transaksiTerakhir['id'] }}</td>
                        <td class="p-3 border print:border-slate-300 text-gray-600">{{ $transaksiTerakhir['tanggal'] ?? date('d-m-Y H:i') }}</td>
                        <td class="p-3 border print:border-slate-300 font-medium text-gray-800">{{ $transaksiTerakhir['pasien'] }}</td>
                        <td class="p-3 border print:border-slate-300 text-gray-600">{{ $transaksiTerakhir['poli'] }} ({{ $transaksiTerakhir['metode'] }})</td>
                        <td class="p-3 border print:border-slate-300 font-bold text-gray-800">Rp {{ number_format($transaksiTerakhir['total'], 0, ',', '.') }}</td>
                        <td class="p-3 border print:border-slate-300">
                            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 rounded text-[10px] font-bold">
                                {{ $transaksiTerakhir['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endif

                    <!-- Data Riwayat Bawaan / Lainnya -->
                    @foreach($riwayat_transaksi as $trx)
                    <tr class="hover:bg-gray-50/50">
                        <td class="p-3 border print:border-slate-300 font-mono font-medium text-sky-600 print:text-black">{{ $trx['id'] }}</td>
                        <td class="p-3 border print:border-slate-300 text-gray-600">{{ $trx['tanggal'] }}</td>
                        <td class="p-3 border print:border-slate-300 font-medium text-gray-800">{{ $trx['pasien'] }}</td>
                        <td class="p-3 border print:border-slate-300 text-gray-600">{{ $trx['layanan'] }}</td>
                        <td class="p-3 border print:border-slate-300 font-bold text-gray-800">Rp {{ number_format($trx['total'], 0, ',', '.') }}</td>
                        <td class="p-3 border print:border-slate-300">
                            <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded text-[10px] font-semibold">
                                {{ $trx['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- TANDA TANGAN (Hanya Muncul Saat Dicetak) -->
    <div class="hidden hidden-print-reset justify-between items-center pt-12 px-6 text-xs text-slate-800">
        <div class="text-center">
            <p>Mengetahui,</p>
            <p class="font-bold">Kepala Klinik KlinikCare</p>
            <div class="h-16"></div>
            <p class="font-bold underline">Dr. H. Ahmad Fauzi, Sp.M</p>
            <p class="text-[10px] text-slate-500">NIP. 19800101 200501 1 003</p>
        </div>
        <div class="text-center">
            <p>Bireuen, {{ date('d F Y') }}</p>
            <p class="font-bold">Petugas Administrasi / Kasir</p>
            <div class="h-16"></div>
            <p class="font-bold underline">Muhammad Subhan</p>
            <p class="text-[10px] text-slate-500">NIK. 20260901 202601 1 001</p>
        </div>
    </div>

</div>
@endsection