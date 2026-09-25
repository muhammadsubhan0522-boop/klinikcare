<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemeriksaan;
use App\Models\Antrean;
use App\Models\Obat; 

class PemeriksaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemeriksaan::with(['antrean', 'pasien', 'dokter'])->latest();

        if ($request->has('cari') && $request->cari != '') {
            $cari = $request->cari;
            $query->where('diagnosa', 'like', "%$cari%")
                  ->orWhereHas('pasien', function($q) use ($cari) {
                      $q->where('nama_lengkap', 'like', "%$cari%")
                        ->orWhere('no_rm', 'like', "%$cari%");
                  });
        }

        $pemeriksaans = $query->paginate(10);
        
        // Ambil semua antrean yang belum selesai
        $antreans = Antrean::with(['pasien', 'dokter'])
            ->where('status', '!=', 'Selesai')
            ->orWhereNull('status')
            ->latest()
            ->get();

        $obats = Obat::all(); 

        return view('pemeriksaan.index', compact('pemeriksaans', 'antreans', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'antrean_id' => 'required',
            'keluhan_utama' => 'required|string', 
            'diagnosa' => 'required|string',
            'tindakan_medis' => 'required|string', // Disesuaikan dengan kolom database
        ]);

        $antrean = Antrean::findOrFail($request->antrean_id);

        Pemeriksaan::create([
            'antrean_id' => $antrean->id,
            'pasien_id' => $antrean->pasien_id ?? null,
            'dokter_id' => $antrean->dokter_id ?? null,
            'keluhan_utama' => $request->keluhan_utama,
            'diagnosa' => $request->diagnosa,
            'tindakan_medis' => $request->tindakan_medis, // Disimpan ke kolom yang benar
        ]);

        // Ubah status antrean menjadi Selesai
        $antrean->status = 'Selesai';
        $antrean->save();

        return redirect()->route('pemeriksaan.index')->with('success', 'Pemeriksaan medis berhasil disimpan dan antrean diselesaikan!');
    }

    public function destroy($id)
    {
        Pemeriksaan::findOrFail($id)->delete();
        return redirect()->route('pemeriksaan.index')->with('success', 'Data riwayat pemeriksaan berhasil dihapus!');
    }
}