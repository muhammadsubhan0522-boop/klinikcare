<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        // Mendukung input 'cari' maupun 'search' dari form view
        $search = $request->input('cari') ?? $request->input('search');
        
        $rekamMedis = Pemeriksaan::with(['pasien', 'dokter', 'antrean'])
            ->when($search, function($query, $search) {
                return $query->whereHas('pasien', function($q) use ($search) {
                    // Menyesuaikan kolom nama pasien (nama_lengkap atau nama_pasien)
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('nama_pasien', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%");
                })->orWhere('diagnosa', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        return view('rekam_medis.index', compact('rekamMedis', 'search'));
    }

    public function show($id)
    {
        // Menggunakan compact('rekamMedis') agar cocok dengan view
        $rekamMedis = Pemeriksaan::with(['pasien', 'dokter', 'antrean'])->findOrFail($id);
        
        return view('rekam_medis.show', compact('rekamMedis'));
    }
}