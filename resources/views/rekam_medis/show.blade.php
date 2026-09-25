@extends('layouts.app')

@section('title', 'Rekam Medis Resmi - KlinikCare')
@section('header-title', 'Detail Rekam Medis Pasien')

@section('content')
<div class="max-w-3xl mx-auto space-y-6 pb-12">

    <!-- TOMBOL AKSI (TIDAK IKUT TERCETAK) -->
    <div class="flex justify-between items-center print:hidden bg-white p-4 rounded-2xl border border-slate-200 shadow-sm">
        <a href="{{ route('rekam-medis.index') }}" class="inline-flex items-center text-xs font-bold text-slate-600 hover:text-sky-600 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Rekam Medis
        </a>
        <button onclick="window.print()" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white text-xs font-bold rounded-xl shadow-md shadow-sky-500/20 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            Cetak Dokumen Medis (PDF / Print)
        </button>
    </div>

    <!-- LEMBAR CETAK UTAMA (FORMAT LAPORAN KLINIK FORMAL) -->
    <div id="printArea" class="bg-white rounded-2xl p-8 sm:p-10 border border-slate-200 shadow-xl space-y-6 text-slate-800 print:shadow-none print:border-none print:p-0">
        
        <!-- KOP SURAT MEDIS -->
        <div class="flex justify-between items-center border-b-2 border-slate-900 pb-5">
            <div class="flex items-center space-x-3.5">
                <div class="w-12 h-12 bg-slate-900 rounded-xl flex items-center justify-center text-white font-black text-xl">
                    K
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">KlinikCare Medical Center</h2>
                    <p class="text-[11px] text-slate-500 font-medium">Jl. Kesehatan Raya No. 128, Banda Aceh | Telp: (0651) 123456</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs font-black uppercase tracking-wider text-slate-900 border border-slate-900 px-3 py-1 rounded">
                    Rekam Medis Resmi
                </div>
                <div class="text-[10px] text-slate-500 font-bold mt-1">ID: #RM-{{ $rekamMedis->id ?? '1' }}</div>
            </div>
        </div>

        <!-- TABEL INFORMASI PASIEN & KUNJUNGAN -->
        <div class="border border-slate-300 rounded-lg overflow-hidden text-xs">
            <div class="bg-slate-100 px-4 py-2 font-black text-slate-700 uppercase tracking-wider border-b border-slate-300">
                I. Informasi Pasien & Kunjungan Medis
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-slate-300">
                <div class="p-4 space-y-1.5">
                    <div><span class="text-slate-400 font-bold">Nama Pasien:</span> <span class="font-extrabold text-slate-900 text-sm">{{ $rekamMedis->pasien->nama_lengkap ?? $rekamMedis->nama_pasien ?? '-' }}</span></div>
                    <div><span class="text-slate-400 font-bold">NIK / No. RM:</span> <span class="font-semibold text-slate-800">{{ $rekamMedis->pasien->nik ?? '-' }}</span></div>
                    <div><span class="text-slate-400 font-bold">Alamat:</span> <span class="font-semibold text-slate-800">{{ $rekamMedis->pasien->alamat ?? '-' }}</span></div>
                </div>
                <div class="p-4 space-y-1.5">
                    <div><span class="text-slate-400 font-bold">Waktu Kunjungan:</span> <span class="font-semibold text-slate-800">{{ $rekamMedis->created_at ? $rekamMedis->created_at->format('d/m/Y H:i') : '-' }}</span></div>
                    <div><span class="text-slate-400 font-bold">Dokter Pemeriksa:</span> <span class="font-extrabold text-slate-900">{{ $rekamMedis->dokter->nama_lengkap ?? 'Dr. Medis' }}</span></div>
                    <div><span class="text-slate-400 font-bold">Nomor Antrean:</span> <span class="font-semibold text-slate-800">A-{{ $rekamMedis->antrean->no_antrean ?? '1' }}</span></div>
                </div>
            </div>
        </div>

        <!-- HASIL PEMERIKSAAN MEDIS (SOAP / DETAIL KLINIS) -->
        <div class="border border-slate-300 rounded-lg overflow-hidden text-xs space-y-0">
            <div class="bg-slate-100 px-4 py-2 font-black text-slate-700 uppercase tracking-wider border-b border-slate-300">
                II. Catatan Pemeriksaan Klinis & Penanganan
            </div>
            
            <div class="divide-y divide-slate-300">
                <!-- Keluhan Utama -->
                <div class="p-4 grid grid-cols-1 sm:grid-cols-4 gap-2">
                    <div class="font-bold text-slate-500 uppercase">Keluhan Utama</div>
                    <div class="sm:col-span-3 font-semibold text-slate-900 leading-relaxed">
                        {{ $rekamMedis->keluhan_utama ?? $rekamMedis->keluhan ?? 'Tidak ada catatan keluhan.' }}
                    </div>
                </div>

                <!-- Diagnosa -->
                <div class="p-4 grid grid-cols-1 sm:grid-cols-4 gap-2 bg-slate-50/50">
                    <div class="font-bold text-slate-500 uppercase">Diagnosa (Assessment)</div>
                    <div class="sm:col-span-3 font-black text-sky-800 text-sm tracking-wide">
                        {{ $rekamMedis->diagnosa ?? '-' }}
                    </div>
                </div>

                <!-- Tindakan & Resep -->
                <div class="p-4 grid grid-cols-1 sm:grid-cols-4 gap-2">
                    <div class="font-bold text-slate-500 uppercase">Tindakan & Terapi Obat</div>
                    <div class="sm:col-span-3 font-medium text-slate-800 leading-relaxed whitespace-pre-line">
                        {{ $rekamMedis->tindakan_medis ?? $rekamMedis->tindakan ?? 'Belum ada catatan tindakan medis.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- TANDA TANGAN DOKTER -->
        <div class="pt-6 flex justify-between items-end text-xs">
            <div class="text-slate-400 italic text-[11px]">
                Dokumen rekam medis sah diterbitkan oleh sistem KlinikCare Medical Center.
            </div>
            <div class="text-center space-y-12 min-w-[220px]">
                <div class="font-bold text-slate-700">Banda Aceh, {{ now()->format('d F Y') }}</div>
                <div>
                    <div class="font-black text-slate-900 underline text-sm">{{ $rekamMedis->dokter->nama_lengkap ?? 'Dr. Medis' }}</div>
                    <div class="text-slate-500 text-[11px] font-semibold mt-0.5">Dokter Penanggung Jawab Medis</div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- CSS KHUSUS PRINT FORMAL -->
<style>
    @media print {
        aside, nav, header, footer, .print\:hidden {
            display: none !important;
        }
        body {
            background-color: white !important;
            color: black !important;
        }
        #printArea {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            width: 100% !important;
            margin: 0 !important;
        }
    }
</style>
@endsection