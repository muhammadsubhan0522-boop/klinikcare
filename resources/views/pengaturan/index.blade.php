@extends('layouts.app')

@section('title', 'Pengaturan Sistem - KlinikCare')
@section('header-title', 'Pengaturan Sistem & Klinik')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Flash Message Sukses (Opsional jika menggunakan session) -->
    @if(session('success'))
        <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold flex items-center gap-3 shadow-sm">
            <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('pengaturan.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Grid Layout Utama: Navigasi Samping & Konten Form -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <!-- Sidebar Navigasi Pengaturan (Tab Kiri) -->
            <div class="lg:col-span-1 space-y-2">
                <div class="bg-white rounded-2xl border border-slate-200 p-3 shadow-sm space-y-1">
                    <button type="button" onclick="switchTab('profil')" id="btn-profil" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition bg-blue-50 text-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Profil & Identitas
                    </button>
                    <button type="button" onclick="switchTab('operasional')" id="btn-operasional" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Jam Operasional
                    </button>
                    <button type="button" onclick="switchTab('keuangan')" id="btn-keuangan" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Tarif & Keuangan
                    </button>
                    <button type="button" onclick="switchTab('notifikasi')" id="btn-notifikasi" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        Notifikasi & WA
                    </button>
                    <button type="button" onclick="switchTab('sistem')" id="btn-sistem" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition text-slate-600 hover:bg-slate-50 hover:text-slate-900">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path></svg>
                        Konfigurasi Sistem
                    </button>
                </div>

                <!-- Info Box Card -->
                <div class="bg-blue-50/60 border border-blue-200/60 rounded-2xl p-4 text-xs text-blue-900 space-y-2">
                    <p class="font-bold flex items-center gap-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pusat Bantuan
                    </p>
                    <p class="text-[11px] text-blue-700 leading-relaxed">Perubahan pada profil dan tarif layanan akan langsung berdampak pada seluruh modul cetak resep dan kasir.</p>
                </div>
            </div>

            <!-- Konten Form Utama (Kanan) -->
            <div class="lg:col-span-3 space-y-6">
                
                <!-- TAB 1: PROFIL & IDENTITAS -->
                <div id="tab-profil" class="tab-content bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="text-base font-extrabold text-slate-900">Profil & Identitas Klinik</h3>
                        <p class="text-xs text-slate-500">Kelola informasi resmi instansi kesehatan yang tertera pada laporan dan cetakan rekam medis.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">Nama Klinik Resmi</label>
                            <input type="text" name="nama_klinik" value="KlinikCare Kesehatan" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">Nomor Izin Operasional</label>
                            <input type="text" name="izin_klinik" value="445/SK-KLINIK/2025/009" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700">Alamat Lengkap Klinik</label>
                        <textarea name="alamat_klinik" rows="3" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition resize-none">Jl. Kesehatan No. 45, Kota Banda Aceh</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="telepon" value="0812-3456-7890" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">Email Resmi Instansi</label>
                            <input type="email" name="email" value="info@klinikcare.com" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- TAB 2: JAM OPERASIONAL -->
                <div id="tab-operasional" class="tab-content hidden bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="text-base font-extrabold text-slate-900">Jam Operasional Pelayanan</h3>
                        <p class="text-xs text-slate-500">Tentukan jadwal buka dan tutup loket pendaftaran serta pelayanan poli dokter.</p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div>
                                <p class="text-xs font-bold text-slate-900">Senin s/d Jumat</p>
                                <p class="text-[11px] text-slate-500">Pelayanan Utama Poli & Pendaftaran</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="text" value="08:00 - 21:00" class="w-32 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-center bg-white">
                            </div>
                        </div>
                        <div class="flex items-center justify-between p-4 rounded-2xl bg-slate-50 border border-slate-100">
                            <div>
                                <p class="text-xs font-bold text-slate-900">Sabtu & Minggu</p>
                                <p class="text-[11px] text-slate-500">Piket Jaga / Unit Darurat (IGD)</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="text" value="09:00 - 15:00" class="w-32 rounded-xl border border-slate-200 px-3 py-2 text-xs font-semibold text-center bg-white">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TAB 3: TARIF & KEUANGAN -->
                <div id="tab-keuangan" class="tab-content hidden bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="text-base font-extrabold text-slate-900">Tarif Layanan & Keuangan</h3>
                        <p class="text-xs text-slate-500">Atur besaran biaya default untuk pendaftaran pasien dan administrasi kasir.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">Biaya Pendaftaran Default (Rp)</label>
                            <input type="number" name="biaya_pendaftaran" value="50000" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">PPN / Pajak Layanan (%)</label>
                            <input type="number" name="pajak_layanan" value="0" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        </div>
                    </div>
                </div>

                <!-- TAB 4: NOTIFIKASI & WA -->
                <div id="tab-notifikasi" class="tab-content hidden bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="text-base font-extrabold text-slate-900">Integrasi Notifikasi & WhatsApp Gateway</h3>
                        <p class="text-xs text-slate-500">Pengaturan pengiriman pengingat antrean dan resep otomatis ke WhatsApp pasien.</p>
                    </div>

                    <div class="space-y-4">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">API Key WhatsApp Gateway</label>
                            <input type="password" value="************************" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 bg-slate-50">
                        </div>
                        <div class="flex items-center justify-between p-4 rounded-2xl border border-slate-200">
                            <div>
                                <p class="text-xs font-bold text-slate-900">Kirim Notifikasi Antrean Otomatis</p>
                                <p class="text-[11px] text-slate-500">Sistem otomatis mengirim pesan saat nomor antrean dipanggil.</p>
                            </div>
                            <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded border-slate-300 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                <!-- TAB 5: KONFIGURASI SISTEM -->
                <div id="tab-sistem" class="tab-content hidden bg-white rounded-3xl border border-slate-200 p-8 shadow-sm space-y-6">
                    <div class="border-b border-slate-100 pb-4">
                        <h3 class="text-base font-extrabold text-slate-900">Konfigurasi Sistem & Cadangan</h3>
                        <p class="text-xs text-slate-500">Pengaturan zona waktu, pemeliharaan sistem, dan pencadangan database.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">Zona Waktu Sistem</label>
                            <select class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 bg-white">
                                <option>Asia/Jakarta (WIB)</option>
                                <option>Asia/Makassar (WITA)</option>
                                <option>Asia/Jayapura (WIT)</option>
                            </select>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-xs font-bold text-slate-700">Mode Pemeliharaan (Maintenance)</label>
                            <select class="w-full rounded-xl border border-slate-200 px-4 py-3 text-xs font-semibold text-slate-800 bg-white">
                                <option>Nonaktif (Sistem Normal)</option>
                                <option>Aktif (Terkunci untuk Pasien)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi Simpan Permanen -->
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-200">
                    <button type="reset" class="px-6 py-3 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition">
                        Reset Perubahan
                    </button>
                    <button type="submit" class="px-8 py-3 rounded-xl bg-blue-600 text-white text-xs font-bold shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                        Simpan Semua Perubahan
                    </button>
                </div>

            </div>

        </div>
    </form>

</div>

<!-- Script Sederhana untuk Tab Switcher -->
<script>
    function switchTab(tabId) {
        // Sembunyikan semua konten tab
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(el => el.classList.add('hidden'));

        // Nonaktifkan semua tombol sidebar
        const buttons = document.querySelectorAll('.lg\\:col-span-1 button');
        buttons.forEach(btn => {
            btn.classList.remove('bg-blue-50', 'text-blue-700', 'font-bold');
            btn.classList.add('text-slate-600', 'font-semibold');
        });

        // Tampilkan tab yang dipilih
        document.getElementById('tab-' + tabId).classList.remove('hidden');

        // Aktifkan tombol yang diklik
        const activeBtn = document.getElementById('btn-' + tabId);
        activeBtn.classList.remove('text-slate-600', 'font-semibold');
        activeBtn.classList.add('bg-blue-50', 'text-blue-700', 'font-bold');
    }
</script>
@endsection