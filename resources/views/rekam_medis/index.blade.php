@extends('layouts.app')

@section('title', 'Rekam Medis & Riwayat Kesehatan - KlinikCare')
@section('header-title', 'Rekam Medis & Riwayat Kesehatan')

@section('content')
<div class="space-y-8 min-h-screen">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div>
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-gradient-to-tr from-sky-500 to-blue-600 rounded-2xl text-white shadow-md shadow-sky-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Rekam Medis & Riwayat Kesehatan</h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Sistem Manajemen Informasi & Rekam Pasien Terintegrasi KlinikCare.</p>
                </div>
            </div>
        </div>
        <div class="inline-flex items-center px-4 py-2 bg-sky-50 border border-sky-100 rounded-full text-sky-700 text-xs font-bold tracking-wide">
            <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse mr-2"></span>
            Pelayanan Medis Aktif
        </div>
    </div>

    <!-- STATS CARDS (METRIK KLINIK OPERASIONAL YANG BERGUNA) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        
        <!-- Card 1: Total Rekam Medis -->
        <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg shadow-sky-500/20 relative overflow-hidden flex items-center justify-between">
            <div class="relative z-10">
                <p class="text-xs font-bold uppercase tracking-wider text-sky-100">Total Rekam Medis</p>
                <h3 class="text-3xl font-black mt-1">{{ isset($rekamMedis) ? $rekamMedis->count() : 0 }} Data</h3>
                <p class="text-[11px] text-sky-200 mt-1 flex items-center">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Arsip klinis tersimpan aman
                </p>
            </div>
            <div class="p-4 bg-white/10 backdrop-blur-md rounded-2xl text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
        </div>

        <!-- Card 2: Pemeriksaan Hari Ini -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Pemeriksaan Hari Ini</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">
                    {{ isset($rekamMedis) ? $rekamMedis->filter(fn($item) => $item->created_at && $item->created_at->isToday())->count() : 0 }} Kasus
                </h3>
                <p class="text-xs text-sky-600 font-semibold mt-1 flex items-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500 mr-1.5"></span>
                    Update real-time hari ini
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Card 3: Pasien Tercatat -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Pasien Tercatat</p>
                <h3 class="text-3xl font-black text-slate-800 mt-1">
                    {{ isset($rekamMedis) ? $rekamMedis->unique('pasien_id')->count() : 0 }} Orang
                </h3>
                <p class="text-xs text-emerald-600 font-semibold mt-1 flex items-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                    Pasien unik dalam rekam medis
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

    </div>

    <!-- MAIN CONTENT CONTAINER -->
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
        
        <!-- FILTER & SEARCH BAR -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Data Rekam Medis Keseluruhan</h3>
                    <p class="text-xs text-slate-500">Daftar riwayat pemeriksaan, diagnosa, dan penanganan pasien secara real-time.</p>
                </div>
            </div>

            <form action="{{ route('rekam-medis.index') }}" method="GET" class="w-full sm:w-auto">
                <div class="relative">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama pasien / diagnosa..." class="text-sm p-3 pl-10 rounded-2xl bg-slate-50 border border-slate-200 text-slate-700 w-full sm:w-72 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>
        </div>

        <!-- TABLE DATA -->
        <div class="overflow-x-auto rounded-2xl border border-slate-100">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50/75 text-slate-500 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="p-4">Tanggal / Waktu</th>
                        <th class="p-4">Pasien</th>
                        <th class="p-4">Dokter Pemeriksa</th>
                        <th class="p-4">Diagnosa</th>
                        <th class="p-4">Keluhan Utama</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @isset($rekamMedis)
                        @forelse($rekamMedis as $rm)
                        <tr class="hover:bg-sky-50/40 transition-colors">
                            <td class="p-4">
                                <div class="font-bold text-slate-800 flex items-center">
                                    <span class="w-2 h-2 rounded-full bg-sky-500 mr-2"></span>
                                    {{ $rm->created_at ? $rm->created_at->format('d/m/Y H:i') : '-' }}
                                </div>
                                <div class="text-[11px] text-slate-400 mt-0.5 ml-4">{{ $rm->created_at ? $rm->created_at->diffForHumans() : '' }}</div>
                            </td>
                            <td class="p-4">
                                <div class="font-extrabold text-slate-900">{{ $rm->pasien->nama_lengkap ?? $rm->nama_pasien ?? 'Pasien' }}</div>
                                <div class="text-xs text-slate-400 mt-0.5 font-normal">NIK: {{ $rm->pasien->nik ?? '-' }}</div>
                            </td>
                            <td class="p-4">
                                <div class="flex items-center space-x-2">
                                    <div class="p-1.5 bg-sky-50 text-sky-600 rounded-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <span class="font-semibold text-slate-800">{{ $rm->dokter->nama_lengkap ?? 'Dr. Medis' }}</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-100 rounded-full text-xs font-bold uppercase tracking-wider">
                                    {{ $rm->diagnosa ?? '-' }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="max-w-xs truncate text-slate-600 text-xs">{{ $rm->keluhan_utama ?? $rm->keluhan ?? '-' }}</div>
                            </td>
                            <td class="p-4 text-center">
                                <a href="{{ route('rekam-medis.show', $rm->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-sky-50 hover:bg-sky-500 text-sky-600 hover:text-white rounded-xl text-xs font-bold transition-all shadow-sm">
                                    <span>Detail</span>
                                    <svg class="w-3.5 h-3.5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-sky-50 text-sky-500 mb-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">Belum ada riwayat rekam medis</h4>
                                <p class="text-xs text-slate-400 mt-1">Data pemeriksaan yang diselesaikan dokter akan tampil otomatis di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>

        <!-- PAGINATION -->
        @if(isset($rekamMedis) && method_exists($rekamMedis, 'hasPages') && $rekamMedis->hasPages())
            <div class="pt-4">
                {{ $rekamMedis->links() }}
            </div>
        @endif

    </div>
</div>
@endsection