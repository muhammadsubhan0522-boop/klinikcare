<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KlinikCare - Sistem Manajemen Kesehatan')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased selection:bg-sky-500 selection:text-white">

    <div class="min-h-screen flex">
        
        <!-- SIDEBAR KIRI (Tema Blue Ice Modern) -->
        <aside class="w-72 bg-white border-r border-slate-200/80 flex flex-col fixed inset-y-0 left-0 z-50 shadow-sm">
            <!-- Logo Brand -->
            <div class="p-6 border-b border-slate-100 flex items-center gap-3">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-sky-600 to-cyan-400 flex items-center justify-center text-white shadow-lg shadow-sky-500/30">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <h1 class="text-base font-black text-slate-900 tracking-tight">KlinikCare</h1>
                    <span class="text-[10px] font-bold text-sky-600 tracking-wider uppercase">Medical Center</span>
                </div>
            </div>

            <!-- Menu Navigasi Sidebar -->
            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <div class="px-3 pb-2 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Menu Utama</div>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('dashboard') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <a href="{{ route('pasien.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('pasien.*') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Data Pasien
                </a>

                <a href="{{ route('dokter.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('dokter.*') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    Data Dokter
                </a>

                <a href="{{ route('antrean.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('antrean.*') ? 'bg-sky-50 text-sky-700 shadow-sm border border-sky-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Antrean Pasien
                </a>

                <div class="pt-4 px-3 pb-2 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Layanan Medis</div>
                
                <a href="{{ route('pemeriksaan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('pemeriksaan.*') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-6 9l2 2 4-4"></path></svg>
                    Pemeriksaan
                </a>

                <a href="{{ route('rekam-medis.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('rekam-medis.*') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Rekam Medis
                </a>

                <a href="{{ route('resep.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('resep.*') || request()->routeIs('resep-obat.*') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                    Resep & Obat
                </a>

                <a href="{{ route('kasir.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('kasir.*') || request()->routeIs('pembayaran.*') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                    Pembayaran / Kasir
                </a>

                <!-- PENGATURAN SISTEM -->
                <div class="pt-4 px-3 pb-2 text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Sistem</div>
                <a href="{{ route('pengaturan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold transition {{ request()->routeIs('pengaturan.*') ? 'bg-sky-50 text-sky-700 shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Pengaturan Sistem
                </a>
            </nav>

            <!-- ✅ PERBAIKAN: Footer Sidebar dengan FORM LOGOUT yang BENAR -->
            <div class="p-4 border-t border-slate-100">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-xs font-bold text-slate-600 hover:bg-rose-50 hover:text-rose-600 transition cursor-pointer">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <!-- KONTEN UTAMA DI KANAN -->
        <div class="flex-1 ml-72 flex flex-col min-h-screen">
            
            <!-- Top Header Navbar -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-40 px-8 py-4 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-extrabold text-slate-900">@yield('header-title', 'Dashboard Utama')</h2>
                    <p class="text-[11px] text-slate-500">Sistem Manajemen Pelayanan Kesehatan Terpadu</p>
                </div>

                <div class="flex items-center gap-4">
                    <span class="px-3.5 py-1.5 rounded-full bg-sky-50 border border-sky-100 text-sky-700 text-xs font-bold flex items-center gap-2 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-cyan-500 animate-ping"></span>
                        Pelayanan Medis Aktif
                    </span>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 p-8">
                @yield('content')
            </main>

        </div>

    </div>

</body>
</html>