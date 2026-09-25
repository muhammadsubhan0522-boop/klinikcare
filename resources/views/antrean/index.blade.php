@extends('layouts.app')

@section('title', 'Manajemen Antrean Pasien - KlinikCare')
@section('header-title', 'Manajemen Antrean Pasien')

@section('content')
<div class="space-y-8 min-h-screen pb-12">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div>
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-gradient-to-tr from-sky-500 to-blue-600 rounded-2xl text-white shadow-md shadow-sky-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Antrean Pasien</h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Sistem pemanggilan antrean otomatis berbasis audio suara dan live status poliklinik.</p>
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

    <!-- BANNER LIVE PANGGILAN KLINIK -->
    <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-sky-500/25 flex flex-col lg:flex-row justify-between items-center gap-6 relative overflow-hidden">
        <div class="absolute -right-10 -bottom-10 w-64 h-64 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
        
        <div class="space-y-2 z-10">
            <div class="inline-flex items-center px-3 py-1 bg-white/20 backdrop-blur-md rounded-full text-[11px] font-extrabold tracking-wider uppercase">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping mr-2"></span>
                Live Panggilan Klinik Audio Aktif
            </div>
            <h2 class="text-2xl sm:text-3xl font-black tracking-tight">Status Antrean Pemeriksaan Dokter</h2>
            <p class="text-xs text-sky-100 max-w-xl font-medium">Klik tombol "Panggil Suara" pada daftar antrean untuk menyuarakan nomor antrean pasien secara otomatis.</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-5 text-center min-w-[240px] shadow-lg z-10">
            <span class="text-[10px] font-extrabold uppercase tracking-widest text-sky-200 block mb-1">Sedang Diperiksa</span>
            <h3 id="liveNomorAntrean" class="text-3xl font-black text-white font-mono tracking-wider">---</h3>
            <p id="liveNamaPasien" class="text-xs font-bold text-sky-100 mt-1 truncate max-w-[200px] mx-auto">Tidak ada pasien aktif</p>
        </div>
    </div>

    <!-- GRID 2 KOLOM -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
        
        <!-- KOLOM KIRI: CETAK ANTREAN BARU -->
        <div class="xl:col-span-5 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6 h-fit">
            <div class="flex items-center space-x-3 border-b border-slate-100 pb-4">
                <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path></svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-900">Cetak Nomor Antrean Baru</h3>
            </div>

            <form action="{{ route('antrean.store') }}" method="POST" class="space-y-4 text-sm">
                @csrf
                
                <div class="p-5 bg-slate-50 border border-slate-200/80 rounded-2xl text-center space-y-1">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Nomor Antrean Otomatis</span>
                    <div class="text-3xl font-black text-sky-600 font-mono">A-003</div>
                    <span class="inline-block px-2.5 py-0.5 bg-emerald-100 text-emerald-800 rounded-full text-[10px] font-bold">READY TO PRINT</span>
                </div>

                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Pilih Pasien <span class="text-rose-500">*</span></label>
                    <select name="pasien_id" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 text-slate-800 font-semibold">
                        <option value="">-- Pilih Pasien --</option>
                        @if(!empty($pasiens))
                            @foreach($pasiens as $pasien)
                                <option value="{{ $pasien->id }}">{{ $pasien->nama_lengkap }} (NIK: {{$pasien->nik }})</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Pilih Dokter Tujuan <span class="text-rose-500">*</span></label>
                    <select name="dokter_id" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 text-slate-800 font-semibold">
                        <option value="">-- Pilih Dokter & Poliklinik --</option>
                        @if(!empty($dokters))
                            @foreach($dokters as $dokter)
                                <option value="{{ $dokter->id }}">{{ $dokter->nama_lengkap }} ({{$dokter->spesialis ?? 'Poli Umum' }})</option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-extrabold rounded-xl shadow-lg shadow-sky-500/30 transition-all flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    <span>Cetak & Simpan Antrean</span>
                </button>
            </form>
        </div>

        <!-- KOLOM KANAN: DAFTAR ANTREAN HARI INI -->
        <div class="xl:col-span-7 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Daftar Antrean Hari Ini</h3>
                        <p class="text-xs text-slate-500">Kelola status pemanggilan antrean secara real-time dengan suara audio.</p>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-100">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50/75 text-slate-500 uppercase text-xs font-bold tracking-wider">
                        <tr>
                            <th class="p-4">No Antrean</th>
                            <th class="p-4">Pasien</th>
                            <th class="p-4">Dokter & Poli</th>
                            <th class="p-4">Status</th>
                            <th class="p-4 text-center">Aksi Audio</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @if(!empty($antreans) && count($antreans) > 0)
                            {{-- PERBAIKAN DI SINI - tambahkan spasi setelah => --}}
                            @foreach($antreans as $index => $antrean)
                                @php
                                    $noAntrean = $antrean->no_antrean ?? 'A-00' . ($index + 1);
                                    $namaPasien = $antrean->pasien->nama_lengkap ?? 'Pasien Umum';
                                    $namaDokter = $antrean->dokter->nama_lengkap ?? 'dr. Spesialis';
                                    $poli = $antrean->dokter->spesialis ?? 'Poli Umum';
                                @endphp
                                <tr class="hover:bg-sky-50/40 transition-colors">
                                    <td class="p-4 font-black text-sky-600 font-mono text-base">{{ $noAntrean }}</td>
                                    <td class="p-4">
                                        <div class="font-extrabold text-slate-900">{{ $namaPasien }}</div>
                                        <div class="text-[11px] text-slate-400 font-mono mt-0.5">RM: {{ $antrean->pasien->no_rm ?? 'RM-00' . ($index + 1) }}</div>
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-slate-800 text-xs">{{ $namaDokter }}</div>
                                        <div class="text-[11px] text-sky-600 font-semibold mt-0.5">{{ $poli }}</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-3 py-1 bg-sky-50 text-sky-700 border border-sky-100 rounded-full text-xs font-black">
                                            Menunggu
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <button type="button" onclick="panggilAntreanAudio('{{ $noAntrean }}', '{{ $namaPasien }}', '{{ $poli }}')" class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl text-xs font-extrabold shadow-sm shadow-sky-500/20 transition-all">
                                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                                            Panggil Suara
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="p-12 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-sky-50 text-sky-500 mb-3">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Belum ada antrean hari ini</h4>
                                    <p class="text-xs text-slate-400 mt-1">Cetak nomor antrean baru menggunakan form di sebelah kiri.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT AUDIO PANGGILAN OTOMATIS -->
<script>
    function panggilAntreanAudio(nomorAntrean, namaPasien, poliTujuan) {
        document.getElementById('liveNomorAntrean').innerText = nomorAntrean;
        document.getElementById('liveNamaPasien').innerText = namaPasien + ' (' + poliTujuan + ')';

        const teksPanggilan = `Nomor antrean, ${nomorAntrean}, atas nama, ${namaPasien}, silakan menuju ke ${poliTujuan}.`;

        if ('speechSynthesis' in window) {
            window.speechSynthesis.cancel();
            const utterance = new SpeechSynthesisUtterance(teksPanggilan);
            utterance.lang = 'id-ID';
            utterance.rate = 0.9;
            utterance.pitch = 1.0;
            window.speechSynthesis.speak(utterance);
        } else {
            alert('Maaf, browser Anda tidak mendukung fitur audio suara otomatis.');
        }
    }
</script>
@endsection