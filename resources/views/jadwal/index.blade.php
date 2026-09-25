@extends('layouts.app')

@section('title', 'Jadwal Dokter')
@section('header-title', 'Jadwal Praktik Poliklinik KlinikCare')

@section('content')
<div class="space-y-6 animate-fade-in pb-12">

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-xs font-semibold flex items-center justify-between shadow-xs">
            <span>✅ {{ session('success') }}</span>
            <span class="text-emerald-400 cursor-pointer" onclick="this.parentElement.remove()">✕</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Form Tambah Jadwal (Kiri - 5 Kolom) -->
        <div class="lg:col-span-5 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
            <div class="border-b border-gray-100 pb-3">
                <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                    <span>📅</span> Tambah Jadwal Praktik
                </h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Hubungkan dokter dengan hari & jam tugas poliklinik.</p>
            </div>

            <form action="{{ route('jadwal.index') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Pilih Dokter *</label>
                    <select name="dokter_id" required class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none bg-white transition">
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $dok)
                            <option value="{{ $dok->id }}">{{ $dok->nama_lengkap }} ({{ $dok->spesialisasi }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Hari Praktik *</label>
                    <select name="hari" required class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none bg-white transition">
                        <option value="">-- Pilih Hari --</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Nama Poliklinik *</label>
                    <input type="text" name="poliklinik" required placeholder="Contoh: Poli Umum / Poli Gigi" class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition">
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Jam Mulai *</label>
                        <input type="time" name="jam_mulai" required class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition">
                    </div>
                    <div>
                        <label class="block text-[11px] font-bold text-gray-600 uppercase tracking-wider mb-1">Jam Selesai *</label>
                        <input type="time" name="jam_selesai" required class="w-full text-xs px-3.5 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-sky-500 focus:border-transparent outline-none transition">
                    </div>
                </div>

                <div class="flex items-center space-x-2 pt-2">
                    <button type="reset" class="w-1/3 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-xs font-bold hover:bg-gray-50 transition">Batal</button>
                    <button type="submit" class="w-2/3 py-2.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white text-xs font-bold shadow-md shadow-sky-600/30 transition">Simpan Jadwal Praktik</button>
                </div>
            </form>
        </div>

        <!-- Daftar Jadwal Dokter (Kanan - 7 Kolom) -->
        <div class="lg:col-span-7 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 space-y-4">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 border-b border-gray-100 pb-3">
                <div>
                    <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                        <span>📋</span> Daftar Jadwal Dokter
                    </h3>
                    <p class="text-[11px] text-gray-400 mt-0.5">Daftar jadwal operasional dokter di berbagai poliklinik.</p>
                </div>
                <!-- Form Pencarian -->
                <form action="{{ route('jadwal.index') }}" method="GET" class="flex items-center space-x-2 w-full sm:w-auto">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari jadwal/poli..." class="text-xs px-3 py-2 rounded-xl border border-gray-200 focus:ring-2 focus:ring-sky-500 outline-none w-full sm:w-48">
                    <button type="submit" class="px-3.5 py-2 bg-gray-800 hover:bg-gray-900 text-white text-xs font-bold rounded-xl transition">Cari</button>
                </form>
            </div>

            <!-- Tabel Data -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 text-[10px] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="py-3 px-2">No</th>
                            <th class="py-3 px-3">Nama Dokter</th>
                            <th class="py-3 px-3">Hari & Poli</th>
                            <th class="py-3 px-3">Jam Praktik</th>
                            <th class="py-3 px-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-xs text-gray-600">
                        @forelse($jadwals as $index => $jadwal)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3.5 px-2 font-semibold text-gray-400">{{ $jadwals->firstItem() ? $jadwals->firstItem() + $index : $index + 1 }}</td>
                                <td class="py-3.5 px-3 font-bold text-gray-800">{{ $jadwal->dokter->nama_lengkap ?? 'Dokter Dihapus' }}</td>
                                <td class="py-3.5 px-3">
                                    <span class="font-bold text-sky-600">{{ $jadwal->hari }}</span>
                                    <div class="text-[10px] text-gray-400">{{ $jadwal->poliklinik }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-medium text-gray-600">🕒 {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</td>
                                <td class="py-3.5 px-3 text-center">
                                    <div class="inline-flex items-center space-x-1.5">
                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-lg transition" title="Hapus Data">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-10 text-gray-400 text-xs">
                                    Belum ada jadwal dokter terdaftar. Silakan tambah melalui form di sebelah kiri.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            <div class="pt-4">
                {{ $jadwals->links() }}
            </div>
        </div>

    </div>

</div>
@endsection