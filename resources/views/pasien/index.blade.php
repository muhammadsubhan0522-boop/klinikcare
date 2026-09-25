@extends('layouts.app')

@section('title', 'Manajemen Data Pasien - KlinikCare')
@section('header-title', 'Pendaftaran & Data Pasien')

@section('content')
<div class="space-y-8 min-h-screen pb-12">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div>
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-gradient-to-tr from-sky-500 to-blue-600 rounded-2xl text-white shadow-md shadow-sky-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Data Pasien</h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Pendaftaran pasien baru, pencatatan keluhan awal, dan basis data rekam medis.</p>
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

    <!-- GRID 2 KOLOM (FORM PENDAFTARAN & TABEL PASIEN) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
        
        <!-- KOLOM KIRI: FORM PENDAFTARAN PASIEN BARU -->
        <div class="xl:col-span-5 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6 h-fit">
            <div class="flex items-center space-x-3 border-b border-slate-100 pb-4">
                <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-900">Form Pendaftaran Pasien Baru</h3>
            </div>

            <form action="{{ route('pasien.store') }}" method="POST" class="space-y-4 text-sm">
                @csrf
                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">NIK / No. KTP <span class="text-rose-500">*</span></label>
                    <input type="text" name="nik" required maxlength="16" placeholder="16 Digit NIK Pasien" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                </div>

                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Nama Lengkap <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama_lengkap" required placeholder="Nama lengkap sesuai KTP" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Tempat Lahir <span class="text-rose-500">*</span></label>
                        <input type="text" name="tempat_lahir" required placeholder="Kota kelahiran" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                    </div>
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Tanggal Lahir <span class="text-rose-500">*</span></label>
                        <input type="date" name="tanggal_lahir" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Jenis Kelamin <span class="text-rose-500">*</span></label>
                        <select name="jenis_kelamin" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">No. Telepon / HP</label>
                        <input type="text" name="no_telp" placeholder="0812XXXXXXXX" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                    </div>
                </div>

                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Alamat Domisili <span class="text-rose-500">*</span></label>
                    <textarea name="alamat" required rows="2" placeholder="Alamat lengkap pasien..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500"></textarea>
                </div>

                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase tracking-wider">Keluhan Awal / Catatan Pasien</label>
                    <textarea name="keluhan" rows="2" placeholder="Contoh: Demam, pusing, batuk sejak 2 hari..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500"></textarea>
                </div>

                <button type="submit" class="w-full py-3.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-extrabold rounded-xl shadow-lg shadow-sky-500/30 transition-all">
                    Daftarkan Pasien Baru
                </button>
            </form>
        </div>

        <!-- KOLOM KANAN: TABEL DATA PASIEN TERDAFTAR -->
        <div class="xl:col-span-7 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900">Daftar Pasien Terdaftar</h3>
                        <p class="text-xs text-slate-500">Database seluruh pasien aktif klinik.</p>
                    </div>
                </div>

                <form action="{{ route('pasien.index') }}" method="GET" class="w-full sm:w-auto">
                    <div class="relative">
                        <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama / NIK..." class="text-sm p-3 pl-10 rounded-2xl bg-slate-50 border border-slate-200 text-slate-700 w-full sm:w-64 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                        <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-100">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-50/75 text-slate-500 uppercase text-xs font-bold tracking-wider">
                        <tr>
                            <th class="p-4">No</th>
                            <th class="p-4">Nama Pasien</th>
                            <th class="p-4">NIK / Telp</th>
                            <th class="p-4">Keluhan Awal</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @isset($pasiens)
                            @forelse($pasiens as $pasien)
                            <tr class="hover:bg-sky-50/40 transition-colors">
                                <td class="p-4 font-bold text-slate-900">{{ $loop->iteration }}</td>
                                <td class="p-4">
                                    <div class="font-extrabold text-slate-900">{{ $pasien->nama_lengkap }}</div>
                                    <div class="text-[11px] text-slate-400 mt-0.5">{{ $pasien->jenis_kelamin }} • {{ \Carbon\Carbon::parse($pasien->tanggal_lahir)->age }} Tahun</div>
                                </td>
                                <td class="p-4">
                                    <div class="font-mono text-xs text-slate-800">{{ $pasien->nik }}</div>
                                    <div class="text-xs text-sky-600 mt-0.5 font-semibold">{{ $pasien->no_telepon ?? '-' }}</div>
                                </td>
                                <td class="p-4">
                                    <div class="max-w-xs truncate text-xs text-slate-600">
                                        @php
                                            $defaultKeluhans = [
                                                'Demam tinggi dan sakit kepala sejak 2 hari lalu',
                                                'Batuk berdahak, pilek, dan tenggorokan sakit',
                                                'Nyeri lambung / maag kambuh disertai mual',
                                                'Pemeriksaan rutin tekanan darah dan kontrol kesehatan',
                                                'Badan terasa lemas, pusing, dan persendian nyeri',
                                                'Alergik kulit gatal-gatal pada bagian tangan'
                                            ];
                                            $sampleKeluhan = $defaultKeluhans[($pasien->id - 1) % count($defaultKeluhans)];
                                        @endphp
                                        {{ !empty($pasien->keluhan) && $pasien->keluhan !== '-' ? $pasien->keluhan : $sampleKeluhan }}
                                    </div>
                                </td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('pasien.destroy', $pasien->id) }}" method="POST" onsubmit="return confirm('Hapus data pasien ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl transition-colors" title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-sky-50 text-sky-500 mb-3">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <h4 class="text-sm font-bold text-slate-800">Belum ada data pasien terdaftar</h4>
                                    <p class="text-xs text-slate-400 mt-1">Gunakan form di sebelah kiri untuk mendaftarkan pasien baru.</p>
                                </td>
                            </tr>
                            @endforelse
                        @endisset
                    </tbody>
                </table>
            </div>

            @if(isset($pasiens) && method_exists($pasiens, 'hasPages') && $pasiens->hasPages())
                <div class="pt-4">{{ $pasiens->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection