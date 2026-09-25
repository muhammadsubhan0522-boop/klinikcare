@extends('layouts.app')

@section('title', 'Manajemen Resep & Obat - KlinikCare')
@section('header-title', 'Inventaris & Resep Obat Apotek')

@section('content')
<div class="space-y-8 min-h-screen pb-12">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <div>
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-gradient-to-tr from-sky-500 to-blue-600 rounded-2xl text-white shadow-md shadow-sky-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Farmasi & Resep Obat</h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Pengelolaan stok obat, apotek, dan integrasi resep pemeriksaan klinis.</p>
                </div>
            </div>
        </div>
        
        <!-- TOMBOL TAMBAH OBAT -->
        <button onclick="document.getElementById('modalObat').classList.remove('hidden')" class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white text-xs font-extrabold rounded-2xl shadow-lg shadow-sky-500/30 transition-all">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Stok Obat Baru
        </button>
    </div>

    <!-- SESSION SUCCESS ALERT -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold shadow-sm flex items-center">
            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl p-6 text-white shadow-lg shadow-sky-500/20 flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-sky-100">Total Jenis Obat</p>
                <h3 class="text-3xl font-black mt-1">{{ isset($obats) ? (method_exists($obats, 'total') ? $obats->total() : $obats->count()) : 0 }} Item</h3>
                <p class="text-[11px] text-sky-200 mt-1">Stok apotek terverifikasi sistem</p>
            </div>
            <div class="p-4 bg-white/10 backdrop-blur-md rounded-2xl text-white">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Status Apotek</p>
                <h3 class="text-xl font-extrabold text-slate-800 mt-1">Operasional Aktif</h3>
                <p class="text-xs text-emerald-600 font-semibold mt-1 flex items-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                    Sinkronisasi resep real-time
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            </div>
        </div>

        <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Standar Pelayanan</p>
                <h3 class="text-xl font-extrabold text-slate-800 mt-1">Klinik Profesional</h3>
                <p class="text-xs text-sky-600 font-semibold mt-1 flex items-center">
                    <span class="w-1.5 h-1.5 rounded-full bg-sky-500 mr-1.5"></span>
                    Farmasi & Resep Terintegrasi
                </p>
            </div>
            <div class="p-4 bg-sky-50 rounded-2xl text-sky-600">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            </div>
        </div>
    </div>

    <!-- MAIN TABLE CONTAINER -->
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6">
        
        <!-- SEARCH BAR -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-4 border-b border-slate-100">
            <div class="flex items-center space-x-3">
                <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Daftar Inventaris Obat</h3>
                    <p class="text-xs text-slate-500">Katalog obat lengkap untuk resep dokter dan penanganan pasien.</p>
                </div>
            </div>

            <form action="{{ route('resep-obat.index') }}" method="GET" class="w-full sm:w-auto">
                <div class="relative">
                    <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari nama obat / kategori..." class="text-sm p-3 pl-10 rounded-2xl bg-slate-50 border border-slate-200 text-slate-700 w-full sm:w-72 focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500 transition-all">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </form>
        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto rounded-2xl border border-slate-100">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50/75 text-slate-500 uppercase text-xs font-bold tracking-wider">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Obat</th>
                        <th class="p-4">Jenis</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Stok</th>
                        <th class="p-4">Harga Satuan</th>
                        <th class="p-4">Keterangan</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @isset($obats)
                        @forelse($obats as $obat)
                        <tr class="hover:bg-sky-50/40 transition-colors">
                            <td class="p-4 font-bold text-slate-900">{{ method_exists($obats, 'firstItem') && $obats->firstItem() ? $obats->firstItem() + $loop->index : $loop->iteration }}</td>
                            <td class="p-4 font-extrabold text-slate-900 flex items-center">
                                <span class="w-2 h-2 rounded-full bg-sky-500 mr-2"></span>
                                {{ $obat->nama }}
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 bg-sky-50 text-sky-700 rounded-lg text-xs font-bold">
                                    {{ $obat->jenis ?? 'Tablet' }}
                                </span>
                            </td>
                            <td class="p-4 text-slate-600">{{ $obat->kategori ?? 'Umum' }}</td>
                            <td class="p-4">
                                <span class="font-black {{ $obat->stok <= 10 ? 'text-rose-600 bg-rose-50 px-2.5 py-1 rounded-md' : 'text-slate-800' }}">
                                    {{ $obat->stok }} Unit
                                </span>
                            </td>
                            <td class="p-4 font-bold text-slate-900">Rp {{ number_format($obat->harga ?? 5000, 0, ',', '.') }}</td>
                            <td class="p-4 text-xs text-slate-500 max-w-xs truncate">{{ $obat->keterangan ?? '-' }}</td>
                            <td class="p-4 text-center">
                                <form action="{{ route('resep-obat.destroy', $obat->id) }}" method="POST" onsubmit="return confirm('Hapus data obat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="p-12 text-center">
                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-sky-50 text-sky-500 mb-3">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                </div>
                                <h4 class="text-sm font-bold text-slate-800">Belum ada data obat di apotek</h4>
                                <p class="text-xs text-slate-400 mt-1">Klik tombol "Tambah Stok Obat Baru" di atas untuk menambahkan data.</p>
                            </td>
                        </tr>
                        @endforelse
                    @endisset
                </tbody>
            </table>
        </div>

        @if(isset($obats) && method_exists($obats, 'hasPages') && $obats->hasPages())
            <div class="pt-4">{{ $obats->links() }}</div>
        @endif

    </div>
</div>

<!-- MODAL TAMBAH OBAT -->
<div id="modalObat" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-sm" onclick="document.getElementById('modalObat').classList.add('hidden')"></div>

        <div class="inline-block px-6 pt-6 pb-6 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-3xl shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-slate-100">
            <div class="flex justify-between items-center mb-5 pb-4 border-b border-slate-100">
                <h3 class="text-lg font-black text-slate-800">Tambah Inventaris Obat</h3>
                <button onclick="document.getElementById('modalObat').classList.add('hidden')" class="text-slate-400 hover:text-rose-500 p-1.5 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <form action="{{ route('resep-obat.store') }}" method="POST" class="space-y-4 text-sm">
                @csrf
                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase">Nama Obat <span class="text-rose-500">*</span></label>
                    <input type="text" name="nama" required placeholder="Contoh: Paracetamol 500mg" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase">Jenis Obat <span class="text-rose-500">*</span></label>
                        <select name="jenis" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                            <option value="Tablet">Tablet</option>
                            <option value="Kapsul">Kapsul</option>
                            <option value="Sirup">Sirup</option>
                            <option value="Injeksi">Injeksi</option>
                            <option value="Salep">Salep / Krim</option>
                        </select>
                    </div>
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase">Kategori <span class="text-rose-500">*</span></label>
                        <select name="kategori" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                            <option value="Analgesik / Penurun Panas">Analgesik / Penurun Panas</option>
                            <option value="Antibiotik">Antibiotik</option>
                            <option value="Vitamin & Suplemen">Vitamin & Suplemen</option>
                            <option value="Antasida / Lambung">Antasida / Lambung</option>
                            <option value="Antihistamin">Antihistamin</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase">Stok Awal <span class="text-rose-500">*</span></label>
                        <input type="number" name="stok" required min="1" placeholder="100" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                    </div>
                    <div>
                        <label class="font-bold text-slate-700 block mb-1 text-xs uppercase">Harga Satuan (Rp) <span class="text-rose-500">*</span></label>
                        <input type="number" name="harga" required min="0" placeholder="5000" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500">
                    </div>
                </div>

                <div>
                    <label class="font-bold text-slate-700 block mb-1 text-xs uppercase">Keterangan / Dosis</label>
                    <textarea name="keterangan" rows="2" placeholder="Aturan pakai atau keterangan tambahan..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500/20 focus:border-sky-500"></textarea>
                </div>

                <div class="pt-4 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('modalObat').classList.add('hidden')" class="px-5 py-2.5 font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50">Batal</button>
                    <button type="submit" class="px-6 py-2.5 font-bold text-white bg-gradient-to-r from-sky-500 to-blue-600 rounded-xl shadow-md shadow-sky-500/20 hover:from-sky-400 hover:to-blue-500">Simpan Obat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection