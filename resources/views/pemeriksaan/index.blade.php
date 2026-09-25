@extends('layouts.app')

@section('title', 'Manajemen Pemeriksaan - KlinikCare')
@section('header-title', 'Pemeriksaan Medis Pasien')

@section('content')
<div class="space-y-8 min-h-screen pb-12">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div>
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-gradient-to-tr from-sky-500 to-blue-600 rounded-2xl text-white shadow-md shadow-sky-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Pemeriksaan Medis Pasien</h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Ruang pemeriksaan dokter, diagnosa klinis, penarikan keluhan otomatis, dan resep obat.</p>
                </div>
            </div>
        </div>
        <div class="inline-flex items-center px-4 py-2 bg-sky-50 border border-sky-100 rounded-full text-sky-700 text-xs font-bold tracking-wide">
            <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse mr-2"></span>
            Pelayanan Medis Aktif
        </div>
    </div>

    <!-- SESSION ALERT -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- GRID 2 KOLOM (FORM PEMERIKSAAN & RIWAYAT) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
        
        <!-- KOLOM KIRI: FORM PEMERIKSAAN MEDIS -->
        <div class="xl:col-span-5 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6 h-fit">
            <div class="flex items-center space-x-3 border-b border-slate-100 pb-4">
                <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-900">Form Pemeriksaan Medis</h3>
            </div>

            <form action="{{ route('pemeriksaan.store') }}" method="POST" class="space-y-4 text-sm">
                @csrf
                
                <!-- DROPDOWN ANTREAN & PASIEN (DENGAN DATA KELUHAN OTOMATIS) -->
                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Pilih Antrean & Pasien <span class="text-rose-500">*</span></label>
                    <select name="antrean_id" id="selectPasien" required onchange="tarikKeluhanPasien(this)" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 text-slate-800 font-semibold">
                        <option value="">-- Pilih Pasien / Antrean --</option>
                        @isset($antreans)
                            @foreach($antreans as $antrean)
                                @php
                                    $namaPasien = $antrean->pasien->nama_lengkap ?? $antrean->nama_pasien ?? 'Pasien';
                                    $keluhanPasien = $antrean->pasien->keluhan ?? $antrean->keluhan ?? 'Pemeriksaan umum dan konsultasi kesehatan';
                                    $noAntrean = $antrean->no_antrean ?? 'A-001';
                                @endphp
                                <option value="{{ $antrean->id }}" data-keluhan="{{ $keluhanPasien }}">
                                    {{ $noAntrean }} | {{ $namaPasien }}
                                </option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                <!-- KELUHAN UTAMA (OTOMATIS TERISI) -->
                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Keluhan Utama (Otomatis dari Pasien) <span class="text-rose-500">*</span></label>
                    <textarea name="keluhan_utama" id="inputKeluhan" required rows="2" placeholder="Keluhan pasien akan tampil otomatis di sini..." class="w-full p-3 bg-sky-50/50 border border-sky-100 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 text-slate-800 font-medium"></textarea>
                </div>

                <!-- DIAGNOSA DOKTER -->
                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Diagnosa Dokter (Assessment) <span class="text-rose-500">*</span></label>
                    <input type="text" name="diagnosa" required placeholder="Contoh: ISPA / Febris / Myalgia" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 font-bold text-sky-900">
                </div>

                <!-- TINDAKAN & RESEP OBAT -->
                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Tindakan Medis & Resep Obat <span class="text-rose-500">*</span></label>
                    <textarea name="tindakan_medis" required rows="3" placeholder="Tuliskan resep obat atau tindakan medis..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-extrabold rounded-xl shadow-lg shadow-sky-500/30 transition-all">
                    Simpan & Selesaikan Pemeriksaan
                </button>
            </form>
        </div>

        <!-- KOLOM KANAN: TABEL RIWAYAT PEMERIKSAAN -->
        <div class="xl:col-span-7 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Riwayat Pemeriksaan Terakhir</h3>
                        <p class="text-xs text-slate-500">Daftar rekam medis pemeriksaan pasien secara real-time.</p>
                    </div>
                </div>

                <form action="{{ route('pemeriksaan.index') }}" method="GET" class="w-full sm:w-auto">
                    <div class="relative">
                        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari pasien / diagnosa..." class="text-sm p-3 pl-10 rounded-2xl bg-slate-50 border border-slate-200 text-slate-700 w-full sm:w-64 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-100">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50/75 text-slate-500 uppercase text-xs font-bold tracking-wider">
                        <tr>
                            <th class="p-4">Pasien</th>
                            <th class="p-4">Dokter</th>
                            <th class="p-4">Diagnosa & Keluhan</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @isset($pemeriksaans)
                            @forelse($pemeriksaans as $pem)
                            <tr class="hover:bg-sky-50/40 transition-colors">
                                <td class="p-4">
                                    <div class="font-extrabold text-slate-900">{{ $pem->pasien->nama_lengkap ?? 'Pasien' }}</div>
                                    <div class="text-[11px] text-sky-600 font-semibold mt-0.5">Antrean: A-{{ $pem->antrean->no_antrean ?? '1' }}</div>
                                </td>
                                <td class="p-4 font-semibold text-slate-800">
                                    {{ $pem->dokter->nama_lengkap ?? 'Dr. Medis' }}
                                </td>
                                <td class="p-4">
                                    <div class="font-black text-sky-700 uppercase tracking-wide text-xs">{{ $pem->diagnosa ?? '-' }}</div>
                                    <div class="text-xs text-slate-500 mt-0.5 max-w-xs truncate">{{ $pem->keluhan_utama ?? '-' }}</div>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('pemeriksaan.destroy', $pem->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat pemeriksaan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-12 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-sky-50 text-sky-500 mb-3">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Belum ada riwayat pemeriksaan</h4>
                                    <p class="text-xs text-slate-400 mt-1">Gunakan form di sebelah kiri untuk memproses pemeriksaan pasien.</p>
                                </td>
                            </tr>
                            @endforelse
                        @endisset
                    </tbody>
                </table>
            </div>

            @if(isset($pemeriksaans) && method_exists($pemeriksaans, 'hasPages') && $pemeriksaans->hasPages())
                <div class="pt-4">{{ $pemeriksaans->links() }}</div>
            @endif
        </div>
    </div>
</div>

<!-- SCRIPT JAVASCRIPT UNTUK MENARIK KELUHAN OTOMATIS -->
<script>
    function tarikKeluhanPasien(selectElement) {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const keluhan = selectedOption.getAttribute('data-keluhan');
        const textareaKeluhan = document.getElementById('inputKeluhan');
        
        if (keluhan && keluhan.trim() !== '') {
            textareaKeluhan.value = keluhan;
        } else {
            textareaKeluhan.value = 'Pemeriksaan umum dan konsultasi kesehatan';
        }
    }
</script>
@endsection