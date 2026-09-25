@extends('layouts.app')

@section('title', 'Manajemen Data Dokter - KlinikCare')
@section('header-title', 'Manajemen Data Dokter')

@section('content')
<div class="max-w-7xl mx-auto space-y-8 pb-10">

    <!-- Header Banner Mini Informasi -->
    <div class="bg-gradient-to-r from-blue-900 via-blue-800 to-indigo-900 rounded-3xl p-6 text-white shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="space-y-2 z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/30 border border-blue-400/30 text-blue-200 text-xs font-semibold">
                <svg class="w-3.5 h-3.5 text-blue-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                Modul Spesialisasi & Jadwal Praktik
            </div>
            <h2 class="text-xl font-black tracking-tight">Direktori Dokter Spesialis & Umum KlinikCare</h2>
            <p class="text-xs text-blue-100 max-w-xl leading-relaxed">Kelola data tenaga medis, spesialisasi, serta atur jadwal praktik harian dokter secara terstruktur dan real-time.</p>
        </div>
        <div class="flex items-center gap-3 z-10 bg-white/10 backdrop-blur-md px-5 py-3 rounded-2xl border border-white/10">
            <div class="w-10 h-10 rounded-xl bg-blue-500 flex items-center justify-center text-white shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
            </div>
            <div>
                <p class="text-[11px] text-blue-200 font-medium">Total Dokter Terdaftar</p>
                <p class="text-lg font-black text-white">{{ isset($dokters) && method_exists($dokters, 'total') ? $dokters->total() : (isset($dokters) ? $dokters->count() : 0) }} Orang</p>
            </div>
        </div>
    </div>

    <!-- Notifikasi Pesan Sukses -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-semibold flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Grid Utama: Form (Kiri) & Tabel (Kanan) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
        
        <!-- KOLOM KIRI: FORM TAMBAH / EDIT DOKTER (Span 5) -->
        <div class="xl:col-span-5 bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-6 relative">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        @if(isset($dokter))
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                        @endif
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900">
                            {{ isset($dokter) ? 'Edit Data Dokter' : 'Tambah Dokter Baru' }}
                        </h3>
                        <p class="text-[11px] text-slate-500">
                            {{ isset($dokter) ? 'Perbarui informasi profil dokter.' : 'Masukkan data lengkap tenaga medis.' }}
                        </p>
                    </div>
                </div>
                @if(isset($dokter))
                    <a href="{{ route('dokter.index') }}" class="text-[11px] text-blue-600 font-bold hover:underline">Batal Edit</a>
                @endif
            </div>

            <!-- Tampilkan Error Validasi -->
            @if ($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-700 p-3 rounded-xl text-xs space-y-1">
                    <p class="font-bold">Terjadi kesalahan pengisian:</p>
                    <ul class="list-disc pl-4 space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form Action (Store / Update) -->
            <form action="{{ isset($dokter) ? route('dokter.update', $dokter->id) : route('dokter.store') }}" method="POST" class="space-y-4">
                @csrf
                @if(isset($dokter))
                    @method('PUT')
                @endif

                <!-- NAMA LENGKAP & GELAR -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Nama Lengkap & Gelar <span class="text-blue-600">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $dokter->nama_lengkap ?? '') }}" placeholder="Contoh: drg. Sarah Melati" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50">
                    </div>
                </div>

                <!-- SPESIALISASI -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Spesialisasi <span class="text-blue-600">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </span>
                        <input type="text" name="spesialisasi" value="{{ old('spesialisasi', $dokter->spesialisasi ?? '') }}" placeholder="Contoh: Dokter Gigi / Dokter Umum" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50">
                    </div>
                </div>

                <!-- NO. TELEPON -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">No. Telepon / WhatsApp <span class="text-blue-600">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </span>
                        <input type="text" name="no_telepon" value="{{ old('no_telepon', $dokter->no_telepon ?? '') }}" placeholder="08xx-xxxx-xxxx" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50">
                    </div>
                </div>

                <!-- JAM PRAKTIK -->
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-slate-700">Jam Praktik <span class="text-blue-600">*</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        <input type="text" name="jam_praktik" value="{{ old('jam_praktik', $dokter->jam_praktik ?? '') }}" placeholder="Contoh: Sen - Sab (08:00 - 13:00)" class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition bg-slate-50/50">
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold shadow-lg shadow-blue-500/25 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        {{ isset($dokter) ? 'Simpan Perubahan Dokter' : 'Simpan & Tambah Dokter' }}
                    </button>
                </div>
            </form>
        </div>

        <!-- KOLOM KANAN: TABEL DATA DOKTER (Span 7) -->
        <div class="xl:col-span-7 bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-extrabold text-slate-900">Daftar Dokter Spesialis & Umum</h3>
                        <p class="text-[11px] text-slate-500">Kelola informasi jadwal praktik, spesialisasi, dan kontak dokter.</p>
                    </div>
                </div>

                <!-- Form Input Pencarian Tabel -->
                <form action="{{ route('dokter.index') }}" method="GET" class="relative w-full sm:w-64">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="cari" value="{{ request('cari') ?? request('search') }}" placeholder="Cari nama / spesialisasi..." class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs font-medium text-slate-800 bg-slate-50/50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                </form>
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto rounded-2xl border border-slate-100">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-[11px] font-bold text-slate-500 uppercase tracking-wider border-b border-slate-100">
                            <th class="py-3.5 px-4 text-center w-12">No</th>
                            <th class="py-3.5 px-4">Nama Lengkap & Gelar</th>
                            <th class="py-3.5 px-4">Spesialisasi</th>
                            <th class="py-3.5 px-4">Jam Praktik</th>
                            <th class="py-3.5 px-4 text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                        @forelse($dokters ?? [] as $index => $item)
                            <tr class="hover:bg-blue-50/30 transition">
                                <td class="py-4 px-4 text-center font-bold text-slate-400">
                                    {{ isset($dokters) && method_exists($dokters, 'firstItem') ? $dokters->firstItem() + $index : $index + 1 }}
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-7 h-7 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-[10px]">
                                            {{ strtoupper(substr($item->nama_lengkap ?? 'DR', 0, 2)) }}
                                        </div>
                                        <div>
                                            <span class="font-bold text-slate-900 block">{{ $item->nama_lengkap }}</span>
                                            <span class="text-[10px] text-slate-400 font-mono">{{ $item->no_telepon }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-700 border border-blue-200/60">
                                        {{ $item->spesialisasi }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-slate-600 text-[11px] font-medium">{{ $item->jam_praktik }}</td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('dokter.edit', $item->id) }}" title="Edit" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 flex items-center justify-center transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('dokter.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data dokter ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus" class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 flex items-center justify-center transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-8 text-center text-slate-400 text-xs">
                                    Belum ada data dokter terdaftar di dalam database atau hasil pencarian tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Pagination -->
            <div class="pt-2">
                @if (isset($dokters) && method_exists($dokters, 'links'))
                    {{ $dokters->withQueryString()->links() }}
                @endif
            </div>
        </div>

    </div>
</div>
@endsection