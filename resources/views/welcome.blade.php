@extends('layouts.app')

@section('title', 'Dashboard')
@section('header-title', 'Dashboard Utama')

@section('content')
<!-- Banner Sambutan -->
<div class="bg-gradient-to-r from-sky-600 to-sky-700 rounded-2xl p-6 text-white shadow-md mb-8 flex justify-between items-center">
    <div>
        <h3 class="text-2xl font-bold mb-2">Selamat Datang di Sistem KlinikCare</h3>
        <p class="text-sky-100 text-sm max-w-2xl">Kelola pendaftaran pasien, rekam medis terpadu, jadwal poliklinik, dan transaksi pembayaran klinik dengan lebih mudah dan cepat.</p>
    </div>
    <div class="hidden md:block text-5xl">🏥</div>
</div>

<!-- Statistik Ringkas -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 flex justify-between items-center">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Pasien Hari Ini</p>
            <h4 class="text-3xl font-extrabold text-gray-800">12</h4>
        </div>
        <div class="w-12 h-12 bg-sky-50 text-sky-600 rounded-xl flex items-center justify-center text-xl">👥</div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 flex justify-between items-center">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Dokter Bertugas</p>
            <h4 class="text-3xl font-extrabold text-gray-800">4</h4>
        </div>
        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl">👨‍⚕️</div>
    </div>

    <div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100 flex justify-between items-center">
        <div>
            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Antrean Selesai</p>
            <h4 class="text-3xl font-extrabold text-gray-800">8</h4>
        </div>
        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-xl">✅</div>
    </div>
</div>

<!-- Akses Cepat Menu -->
<div class="bg-white p-6 rounded-2xl shadow-xs border border-gray-100">
    <h4 class="text-base font-bold text-gray-800 mb-4">Aktivitas & Layanan Cepat</h4>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('pasien.index') }}" class="p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-sky-50 hover:border-sky-200 transition flex items-center space-x-4 group">
            <div class="w-10 h-10 rounded-lg bg-sky-100 text-sky-600 flex items-center justify-center font-bold text-lg group-hover:bg-sky-600 group-hover:text-white transition">➕</div>
            <div>
                <h5 class="font-bold text-gray-800 text-sm group-hover:text-sky-700">Pendaftaran Pasien Baru</h5>
                <p class="text-xs text-gray-500">Daftarkan pasien baru yang datang berobat ke klinik.</p>
            </div>
        </a>

        <a href="#" class="p-4 rounded-xl border border-gray-100 bg-gray-50 hover:bg-sky-50 hover:border-sky-200 transition flex items-center space-x-4 group">
            <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg group-hover:bg-blue-600 group-hover:text-white transition">📝</div>
            <div>
                <h5 class="font-bold text-gray-800 text-sm group-hover:text-blue-700">Input Rekam Medis</h5>
                <p class="text-xs text-gray-500">Catat diagnosa, tindakan medis, dan resep obat pasien.</p>
            </div>
        </a>
    </div>
</div>
@endsection