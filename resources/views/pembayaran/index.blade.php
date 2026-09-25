@extends('layouts.app')

@section('title', 'Kasir & Pembayaran - KlinikCare')
@section('header-title', 'Kasir & Pembayaran Klinik')

@section('content')
<div class="space-y-8 min-h-screen pb-12">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm print:hidden">
        <div>
            <div class="flex items-center space-x-3">
                <div class="p-2.5 bg-gradient-to-tr from-sky-500 to-blue-600 rounded-2xl text-white shadow-md shadow-sky-500/20">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Kasir & Pembayaran Medis</h1>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Pemrosesan tagihan pasien, integrasi BPJS, transfer bank, QRIS, dan cetak bukti kasir.</p>
                </div>
            </div>
        </div>
        <div class="inline-flex items-center px-4 py-2 bg-sky-50 border border-sky-100 rounded-full text-sky-700 text-xs font-bold tracking-wide">
            <span class="w-2 h-2 rounded-full bg-sky-500 animate-pulse mr-2"></span>
            Pelayanan Medis Aktif
        </div>
    </div>

    <!-- SESSION ALERTS -->
    @if(session('success'))
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold shadow-sm flex items-center print:hidden">
        <svg class="w-5 h-5 mr-2 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- UTAMA: GRID 2 KOLOM -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 print:block">
        
        <!-- KOLOM KIRI: RINCIAN TAGIHAN -->
        <div class="lg:col-span-5 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6 h-fit print:shadow-none print:border-none print:p-0">
            <div class="flex items-center space-x-3 border-b border-slate-100 pb-4 print:hidden">
                <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-900">Rincian Tagihan Pasien</h3>
            </div>

            <div class="space-y-4 text-sm bg-slate-50/70 p-5 rounded-2xl border border-slate-100">
                <div class="flex justify-between items-center pb-3 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium text-xs">No. Transaksi</span>
                    <span class="font-bold text-slate-900 font-mono">TRX-2026-001</span>
                </div>
                <div class="flex justify-between items-center pb-3 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium text-xs">Nama Pasien</span>
                    <span class="font-extrabold text-slate-900">{{ $tagihan['nama_pasien'] ?? 'Budi Santoso' }}</span>
                </div>
                <div class="flex justify-between items-center pb-3 border-b border-slate-200/60">
                    <span class="text-slate-500 font-medium text-xs">Poli / Layanan</span>
                    <span class="font-bold text-sky-700 bg-sky-50 px-2.5 py-1 rounded-lg text-xs">{{ $tagihan['poli'] ?? 'Poli Umum' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-slate-500 font-medium text-xs">Metode Pembayaran</span>
                    <span id="labelMetodeTerpilih" class="font-extrabold {{ session('metode_terpilih') ? 'text-sky-700 bg-sky-50' : 'text-amber-600 bg-amber-50' }} px-2.5 py-1 rounded-lg text-xs">
                        {{ session('metode_terpilih') ?? 'Belum Dipilih' }}
                    </span>
                </div>
            </div>

            <!-- TOTAL TAGIHAN -->
            <div class="p-5 bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl text-white shadow-lg shadow-sky-500/20 flex justify-between items-center">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-sky-100">Total Tagihan</p>
                    <h2 id="displayTotal" class="text-3xl font-black mt-0.5">
                        Rp {{ session('total_bayar') !== null ? number_format(session('total_bayar'), 0, ',', '.') : '150.000' }}
                    </h2>
                </div>
                <div class="p-3 bg-white/10 backdrop-blur-md rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            <!-- STATUS TRANSAKSI (MENDETEKSI SESSION LUNAS) -->
            <div class="p-4 rounded-2xl {{ session('status_lunas') ? 'bg-emerald-50 border-emerald-200 text-emerald-800' : 'bg-amber-50 border-amber-200 text-amber-800' }} border flex items-center justify-between print:hidden">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-wider {{ session('status_lunas') ? 'text-emerald-600' : 'text-amber-600' }}">Status Transaksi</p>
                    <p class="text-xs font-semibold mt-0.5">
                        {{ session('status_lunas') ? 'Pembayaran Selesai & Terverifikasi' : 'Menunggu konfirmasi pembayaran' }}
                    </p>
                </div>
                <span class="px-3 py-1 {{ session('status_lunas') ? 'bg-emerald-500' : 'bg-amber-500' }} text-white rounded-full text-xs font-black tracking-wide shadow-sm">
                    {{ session('status_lunas') ? 'LUNAS' : 'PENDING' }}
                </span>
            </div>
        </div>

        <!-- KOLOM KANAN: PILIH METODE & FORM -->
        <div class="lg:col-span-7 bg-white rounded-3xl p-6 border border-slate-100 shadow-sm space-y-6 print:hidden">
            <div class="flex items-center space-x-3 border-b border-slate-100 pb-4">
                <div class="p-2 bg-sky-50 rounded-xl text-sky-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </div>
                <h3 class="text-base font-extrabold text-slate-900">Pilih Metode Pembayaran & Penjamin</h3>
            </div>

            <form action="{{ route('pembayaran.process') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="metode" id="inputMetode" value="{{ session('metode_terpilih') }}">

                <!-- OPSI 4 PILIHAN METODE -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    
                    <div onclick="pilihMetode('Cash (Tunai)', this)" class="payment-card cursor-pointer p-4 rounded-2xl border-2 border-slate-200 hover:border-sky-500 transition-all flex flex-col items-center text-center space-y-2 bg-slate-50/50">
                        <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div><h4 class="font-extrabold text-slate-800 text-xs">Cash (Tunai)</h4></div>
                    </div>

                    <div onclick="pilihMetode('Transfer Bank', this)" class="payment-card cursor-pointer p-4 rounded-2xl border-2 border-slate-200 hover:border-sky-500 transition-all flex flex-col items-center text-center space-y-2 bg-slate-50/50">
                        <div class="p-2.5 bg-sky-50 text-sky-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path></svg>
                        </div>
                        <div><h4 class="font-extrabold text-slate-800 text-xs">Transfer Bank</h4></div>
                    </div>

                    <div onclick="pilihMetode('QRIS / E-Wallet', this)" class="payment-card cursor-pointer p-4 rounded-2xl border-2 border-slate-200 hover:border-sky-500 transition-all flex flex-col items-center text-center space-y-2 bg-slate-50/50">
                        <div class="p-2.5 bg-blue-50 text-blue-600 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                        </div>
                        <div><h4 class="font-extrabold text-slate-800 text-xs">QRIS / E-Wallet</h4></div>
                    </div>

                    <div onclick="pilihMetode('BPJS Kesehatan', this)" class="payment-card cursor-pointer p-4 rounded-2xl border-2 border-slate-200 hover:border-emerald-500 transition-all flex flex-col items-center text-center space-y-2 bg-emerald-50/30">
                        <div class="p-2.5 bg-emerald-100 text-emerald-700 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                        <div><h4 class="font-extrabold text-emerald-800 text-xs">BPJS Kesehatan</h4></div>
                    </div>

                </div>

                <!-- SUB-SECTION BANK -->
                <div id="bankSection" class="hidden p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-4">
                    <h4 class="text-xs font-black uppercase text-slate-700 tracking-wider">Pilih Rekening Resmi KlinikCare</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <label class="flex items-center p-3 bg-white rounded-xl border border-slate-200 cursor-pointer">
                            <input type="radio" name="bank_tujuan" value="BCA" class="mr-3" checked>
                            <div><div class="font-bold text-slate-900 text-xs">Bank BCA</div><div class="font-mono text-sky-700 font-extrabold text-xs">123-456-7890</div></div>
                        </label>
                        <label class="flex items-center p-3 bg-white rounded-xl border border-slate-200 cursor-pointer">
                            <input type="radio" name="bank_tujuan" value="Mandiri" class="mr-3">
                            <div><div class="font-bold text-slate-900 text-xs">Bank Mandiri</div><div class="font-mono text-sky-700 font-extrabold text-xs">987-654-3210</div></div>
                        </label>
                    </div>
                </div>

                <!-- SUB-SECTION QRIS -->
                <div id="qrisSection" class="hidden p-5 bg-sky-50/60 rounded-2xl border border-sky-200 flex flex-col items-center text-center space-y-3">
                    <span class="px-3 py-1 bg-sky-600 text-white rounded-full text-[10px] font-bold uppercase">Scan via HP</span>
                    <div class="p-3 bg-white rounded-xl shadow-sm border border-slate-200 inline-block">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=KlinikCare-Payment-TRX2026001" alt="QRIS" class="w-36 h-36 object-contain mx-auto rounded">
                    </div>
                </div>

                <!-- SUB-SECTION BPJS -->
                <div id="bpjsSection" class="hidden p-5 bg-emerald-50 rounded-2xl border border-emerald-200 space-y-3">
                    <div class="flex items-center space-x-2 text-emerald-800">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        <h4 class="text-xs font-black uppercase tracking-wider">Verifikasi Peserta BPJS Kesehatan</h4>
                    </div>
                    <input type="text" name="no_bpjs" placeholder="Nomor Kartu BPJS / NIK Pasien" class="w-full p-2.5 text-xs bg-white border border-emerald-300 rounded-xl font-mono">
                    <div class="text-[11px] text-emerald-700 font-medium">* Status: <span class="font-bold underline">AKTIF (Tagihan otomatis Rp 0)</span></div>
                </div>

                <!-- TOMBOL SUBMIT KE BACKEND -->
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-400 hover:to-blue-500 text-white font-extrabold rounded-2xl shadow-lg shadow-sky-500/30 transition-all flex items-center justify-center space-x-2 text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    <span>Konfirmasi & Selesaikan Pembayaran</span>
                </button>
            </form>
        </div>
    </div>

    <!-- STRUK BUKTI PEMBAYARAN RESMI (MUNCUL OTOMATIS JIKA STATUS LUNAS) -->
    @if(session('status_lunas'))
    <div id="receiptSection" class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-xl space-y-6 max-w-2xl mx-auto print:block print:shadow-none print:border-none print:p-0">
        <div class="flex justify-between items-center border-b-2 border-slate-900 pb-5">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-slate-900 rounded-lg flex items-center justify-center text-white font-black">K</div>
                <div>
                    <h3 class="font-black text-slate-900 text-lg uppercase">KlinikCare Medical Center</h3>
                    <p class="text-[10px] text-slate-500">Jl. Kesehatan Raya No. 128, Banda Aceh</p>
                </div>
            </div>
            <div class="text-right">
                <span class="px-2.5 py-1 bg-emerald-100 text-emerald-800 font-extrabold text-[10px] uppercase rounded">LUNAS / VERIFIED</span>
                <p class="text-[10px] text-slate-400 font-mono mt-1">TRX-2026-001</p>
            </div>
        </div>

        <div class="space-y-3 text-xs">
            <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                <span class="text-slate-500">Nama Pasien:</span>
                <span class="font-bold text-slate-900">{{ $tagihan['nama_pasien'] ?? 'Budi Santoso' }}</span>
            </div>
            <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                <span class="text-slate-500">Layanan / Poli:</span>
                <span class="font-bold text-slate-900">{{ $tagihan['poli'] ?? 'Poli Umum' }}</span>
            </div>
            <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                <span class="text-slate-500">Metode / Penjamin:</span>
                <span class="font-extrabold text-sky-700">{{ session('metode_terpilih') }}</span>
            </div>
            <div class="flex justify-between border-b border-dashed border-slate-200 pb-2">
                <span class="text-slate-500">Waktu Transaksi:</span>
                <span class="font-bold text-slate-900">{{ now()->format('d/m/Y H:i') }}</span>
            </div>
            <div class="flex justify-between pt-2 text-sm font-black">
                <span>Total Pembayaran:</span>
                <span class="text-sky-700">Rp {{ number_format(session('total_bayar'), 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="pt-6 flex justify-between items-center border-t border-slate-100 text-xs print:hidden">
            <button onclick="window.print()" class="px-5 py-2.5 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition">
                🖨️ Cetak Struk / Bukti Pembayaran
            </button>
            <a href="{{ route('pembayaran.index') }}" class="text-sky-600 hover:text-sky-800 font-semibold underline">
                Transaksi Baru / Selesai
            </a>
        </div>
    </div>
    @endif
</div>

<!-- JAVASCRIPT LOGIC -->
<script>
    function pilihMetode(metode, element) {
        document.getElementById('inputMetode').value = metode;
        document.getElementById('labelMetodeTerpilih').innerText = metode;
        document.getElementById('labelMetodeTerpilih').className = "font-extrabold text-sky-700 bg-sky-50 px-2.5 py-1 rounded-lg text-xs";

        document.querySelectorAll('.payment-card').forEach(card => {
            card.classList.remove('border-sky-500', 'border-emerald-500', 'bg-sky-50/20', 'bg-emerald-50/20', 'shadow-md');
            card.classList.add('border-slate-200', 'bg-slate-50/50');
        });

        if(metode === 'BPJS Kesehatan') {
            element.classList.remove('border-slate-200', 'bg-slate-50/50');
            element.classList.add('border-emerald-500', 'bg-emerald-50/20', 'shadow-md');
            document.getElementById('displayTotal').innerText = 'Rp 0 (Ditanggung BPJS)';
        } else {
            element.classList.remove('border-slate-200', 'bg-slate-50/50');
            element.classList.add('border-sky-500', 'bg-sky-50/20', 'shadow-md');
            document.getElementById('displayTotal').innerText = 'Rp 150.000';
        }

        document.getElementById('bankSection').classList.toggle('hidden', metode !== 'Transfer Bank');
        document.getElementById('qrisSection').classList.toggle('hidden', metode !== 'QRIS / E-Wallet');
        document.getElementById('bpjsSection').classList.toggle('hidden', metode !== 'BPJS Kesehatan');
    }
</script>

<style>
    @media print {
        aside, nav, header, footer, .print\:hidden {
            display: none !important;
        }
        body {
            background-color: white !important;
        }
        #receiptSection {
            display: block !important;
            border: none !important;
            box-shadow: none !important;
            width: 100% !important;
            margin: 0 !important;
        }
    }
</style>
@endsection