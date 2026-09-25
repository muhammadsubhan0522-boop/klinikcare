<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\AntreanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ResepObatController;
use App\Http\Controllers\PembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Redirect halaman utama langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// 2. AUTHENTICATION (GUEST ROUTES)
// Hanya bisa diakses jika BELUM login
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// 3. PROTECTED ROUTES (MEMERLUKAN LOGIN)
// Hanya bisa diakses jika SUDAH login
Route::middleware(['auth'])->group(function () {

    // Logout route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // ==========================================
    // DASHBOARD & PENGATURAN
    // ==========================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home'); // Alias /home ke Dashboard
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
    Route::put('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');

    // ==========================================
    // ANTREAN
    // ==========================================
    Route::get('/antrean', [AntreanController::class, 'index'])->name('antrean.index');
    Route::post('/antrean', [AntreanController::class, 'store'])->name('antrean.store');
    Route::post('/antrean/{id}/panggil', [AntreanController::class, 'panggil'])->name('antrean.panggil');
    Route::delete('/antrean/{id}', [AntreanController::class, 'destroy'])->name('antrean.destroy');

    // ==========================================
    // 1. MANAJEMEN PASIEN
    // ==========================================
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
    Route::get('/pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('/pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    // ==========================================
    // 2. MANAJEMEN DOKTER
    // ==========================================
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/{id}', [DokterController::class, 'show'])->name('dokter.show');
    Route::get('/dokter/{id}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter/{id}', [DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{id}', [DokterController::class, 'destroy'])->name('dokter.destroy');

    // ==========================================
    // 3. MANAJEMEN PEMERIKSAAN
    // ==========================================
    Route::get('/pemeriksaan', [PemeriksaanController::class, 'index'])->name('pemeriksaan.index');
    Route::post('/pemeriksaan', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
    Route::get('/pemeriksaan/{id}', [PemeriksaanController::class, 'show'])->name('pemeriksaan.show');
    Route::get('/pemeriksaan/{id}/edit', [PemeriksaanController::class, 'edit'])->name('pemeriksaan.edit');
    Route::put('/pemeriksaan/{id}', [PemeriksaanController::class, 'update'])->name('pemeriksaan.update');
    Route::delete('/pemeriksaan/{id}', [PemeriksaanController::class, 'destroy'])->name('pemeriksaan.destroy');

    // ==========================================
    // 4. MANAJEMEN REKAM MEDIS
    // ==========================================
    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::post('/rekam-medis', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    Route::get('/rekam-medis/{id}', [RekamMedisController::class, 'show'])->name('rekam-medis.show');
    Route::get('/rekam-medis/{id}/edit', [RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
    Route::put('/rekam-medis/{id}', [RekamMedisController::class, 'update'])->name('rekam-medis.update');
    Route::delete('/rekam-medis/{id}', [RekamMedisController::class, 'destroy'])->name('rekam-medis.destroy');

    // ==========================================
    // 5. MANAJEMEN RESEP OBAT
    // ==========================================
    Route::get('/resep', [ResepObatController::class, 'index'])->name('resep.index');
    Route::post('/resep', [ResepObatController::class, 'store'])->name('resep.store');
    Route::get('/resep/{id}', [ResepObatController::class, 'show'])->name('resep.show');
    Route::get('/resep/{id}/edit', [ResepObatController::class, 'edit'])->name('resep.edit');
    Route::put('/resep/{id}', [ResepObatController::class, 'update'])->name('resep.update');
    Route::delete('/resep/{id}', [ResepObatController::class, 'destroy'])->name('resep.destroy');

    // Alias untuk resep-obat
    Route::get('/resep-obat', [ResepObatController::class, 'index'])->name('resep-obat.index');
    Route::post('/resep-obat', [ResepObatController::class, 'store'])->name('resep-obat.store');
    Route::get('/resep-obat/{id}', [ResepObatController::class, 'show'])->name('resep-obat.show');
    Route::get('/resep-obat/{id}/edit', [ResepObatController::class, 'edit'])->name('resep-obat.edit');
    Route::put('/resep-obat/{id}', [ResepObatController::class, 'update'])->name('resep-obat.update');
    Route::delete('/resep-obat/{id}', [ResepObatController::class, 'destroy'])->name('resep-obat.destroy');

    // ==========================================
    // 6. MANAJEMEN KASIR / PEMBAYARAN
    // ==========================================
    Route::get('/kasir', [PembayaranController::class, 'index'])->name('kasir.index');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    
    Route::post('/kasir', [PembayaranController::class, 'store'])->name('kasir.store');
    Route::post('/pembayaran/proses', [PembayaranController::class, 'process'])->name('pembayaran.process');
    
    Route::get('/kasir/{id}', [PembayaranController::class, 'show'])->name('kasir.show');
    Route::get('/kasir/{id}/edit', [PembayaranController::class, 'edit'])->name('kasir.edit');
    Route::put('/kasir/{id}', [PembayaranController::class, 'update'])->name('kasir.update');
    Route::delete('/kasir/{id}', [PembayaranController::class, 'destroy'])->name('kasir.destroy');

});