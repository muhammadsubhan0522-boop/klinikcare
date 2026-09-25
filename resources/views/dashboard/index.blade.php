@extends('layouts.app')

@section('title', 'Dashboard KlinikCare - Sistem Manajemen Kesehatan')
@section('header-title', 'Dashboard & Pusat Kontrol KlinikCare')

@section('content')
<div class="space-y-8 min-h-screen pb-12">
    
    <!-- HEADER KONTROL -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dashboard & Pusat Kontrol</h1>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Sistem Manajemen Informasi & Pelayanan Kesehatan Terpadu KlinikCare.</p>
        </div>
        <div class="inline-flex items-center px-4 py-2 bg-sky-50 border border-sky-100 rounded-full text-sky-700 text-xs font-bold tracking-wide shadow-sm">
            <span class="w-2 h-2 rounded-full bg-cyan-500 animate-ping mr-2"></span>
            Sistem Terintegrasi Online
        </div>
    </div>

    <!-- 4 STATS CARDS UTAMA -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        <!-- Total Pasien -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between relative overflow-hidden group hover:border-sky-300 transition-all">
            <div class="space-y-1">
                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400">Total Pasien</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalPasien ?? 0 }}</h3>
                <p class="text-[11px] text-sky-600 font-semibold flex items-center mt-1">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Data pasien terdaftar
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600 group-hover:bg-gradient-to-tr group-hover:from-sky-500 group-hover:to-blue-600 group-hover:text-white transition-all shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
        </div>

        <!-- Total Dokter -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between relative overflow-hidden group hover:border-sky-300 transition-all">
            <div class="space-y-1">
                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400">Total Dokter</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalDokter ?? 0 }}</h3>
                <p class="text-[11px] text-sky-600 font-semibold flex items-center mt-1">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    Spesialis aktif & siap
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600 group-hover:bg-gradient-to-tr group-hover:from-sky-500 group-hover:to-blue-600 group-hover:text-white transition-all shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
        </div>

        <!-- Antrean Hari Ini -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between relative overflow-hidden group hover:border-sky-300 transition-all">
            <div class="space-y-1">
                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400">Antrean Hari Ini</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalAntrean ?? 0 }}</h3>
                <p class="text-[11px] text-emerald-600 font-semibold flex items-center mt-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5 animate-pulse"></span>
                    Aktif berjalan lancar
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600 group-hover:bg-gradient-to-tr group-hover:from-sky-500 group-hover:to-blue-600 group-hover:text-white transition-all shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        </div>

        <!-- Pemeriksaan Medis -->
        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between relative overflow-hidden group hover:border-sky-300 transition-all">
            <div class="space-y-1">
                <p class="text-xs font-extrabold uppercase tracking-wider text-slate-400">Pemeriksaan Medis</p>
                <h3 class="text-3xl font-black text-slate-900">{{ $totalPemeriksaan ?? 0 }}</h3>
                <p class="text-[11px] text-sky-600 font-semibold flex items-center mt-1">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    Dalam proses penanganan
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600 group-hover:bg-gradient-to-tr group-hover:from-sky-500 group-hover:to-blue-600 group-hover:text-white transition-all shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
            </div>
        </div>

    </div>

    <!-- BAGIAN BAWAH: GRAFIK GARIS & ANTREAN AKTIF DARI DATABASE -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- KOLOM KIRI: GRAFIK GARIS BERANIMASI -->
        <div class="lg:col-span-8 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Grafik Kunjungan Pasien Mingguan</h3>
                    <p class="text-xs text-slate-500">Statistik analitik kunjungan pasien baru dan lama secara real-time.</p>
                </div>
                <div class="flex items-center space-x-4 text-xs font-bold">
                    <span class="flex items-center text-slate-600">
                        <span class="w-3 h-3 rounded-full bg-sky-500 inline-block mr-1.5 shadow-sm"></span> Pasien Baru
                    </span>
                    <span class="flex items-center text-slate-600">
                        <span class="w-3 h-3 rounded-full bg-blue-400 inline-block mr-1.5 shadow-sm"></span> Pasien Lama
                    </span>
                </div>
            </div>

            <!-- CANVAS CHART.JS LINE CHART -->
            <div class="relative h-72 w-full">
                <canvas id="kunjunganLineChart"></canvas>
            </div>
        </div>

        <!-- KOLOM KANAN: ANTREAN AKTIF DARI DATABASE -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-5 flex flex-col justify-between">
            <div class="flex justify-between items-center border-b border-slate-100 pb-4">
                <h3 class="text-base font-extrabold text-slate-900">Antrean Aktif</h3>
                <a href="{{ route('antrean.index') }}" class="text-xs font-bold text-sky-600 hover:text-sky-700 transition-colors">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @if(!empty($antreansAktif) && count($antreansAktif) > 0)
                    @foreach($antreansAktif as $antrean)
                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 flex items-center justify-between hover:border-sky-200 transition-all">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="font-black text-slate-900 text-sm">{{ $antrean->no_antrean ?? 'A-001' }}</span>
                                    <span class="text-slate-300">•</span>
                                    <span class="font-extrabold text-slate-800 text-xs">{{ $antrean->pasien->nama_lengkap ?? 'Pasien Umum' }}</span>
                                </div>
                                <div class="text-[11px] text-slate-500 mt-0.5">{{ $antrean->dokter->nama_lengkap ?? 'dr. Spesialis' }} ({{ $antrean->dokter->spesialis ?? 'Poli' }})</div>
                            </div>
                            <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-lg text-[10px] font-black uppercase">Menunggu</span>
                        </div>
                    @endforeach
                @else
                    <div class="p-6 text-center text-slate-400 text-xs">
                        Belum ada antrean aktif saat ini.
                    </div>
                @endif
            </div>

            <a href="{{ route('antrean.index') }}" class="w-full py-3 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-extrabold rounded-2xl text-xs text-center shadow-md shadow-sky-500/20 transition-all block">
                Buka Panel Antrean Lengkap
            </a>
        </div>

    </div>
</div>

<!-- CDN CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('kunjunganLineChart').getContext('2d');
    
    const gradientPasienBaru = ctx.createLinearGradient(0, 0, 0, 300);
    gradientPasienBaru.addColorStop(0, 'rgba(14, 165, 233, 0.3)');
    gradientPasienBaru.addColorStop(1, 'rgba(14, 165, 233, 0.0)');

    const gradientPasienLama = ctx.createLinearGradient(0, 0, 0, 300);
    gradientPasienLama.addColorStop(0, 'rgba(59, 130, 246, 0.2)');
    gradientPasienLama.addColorStop(1, 'rgba(59, 130, 246, 0.0)');

    const kunjunganLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [
                {
                    label: 'Pasien Baru',
                    data: [12, 19, 15, 25, 32, 28, 14],
                    borderColor: '#0ea5e9',
                    backgroundColor: gradientPasienBaru,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#0ea5e9',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                },
                {
                    label: 'Pasien Lama',
                    data: [8, 14, 11, 18, 24, 20, 10],
                    borderColor: '#3b82f6',
                    backgroundColor: gradientPasienLama,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#3b82f6',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleFont: { size: 12, weight: 'bold' },
                    bodyFont: { size: 11 },
                    padding: 12,
                    cornerRadius: 12,
                    displayColors: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(226, 232, 240, 0.6)', borderDash: [4, 4] },
                    ticks: { font: { size: 11, weight: 'bold' }, color: '#64748b' }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, weight: 'bold' }, color: '#64748b' }
                }
            }
        }
    });
</script>
@endsection