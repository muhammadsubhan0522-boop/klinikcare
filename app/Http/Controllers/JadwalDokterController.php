<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalDokter;
use App\Models\Dokter;

class JadwalDokterController extends Controller
{
    public function index(Request $request)
    {
        $query = JadwalDokter::with('dokter')->latest();
        if ($request->has('cari') && $request->cari != '') {
            $cari = $request->cari;
            $query->where('hari', 'like', "%$cari%")
                  ->orWhere('poliklinik', 'like', "%$cari%")
                  ->orWhereHas('dokter', function($q) use ($cari) {
                      $q->where('nama_lengkap', 'like', "%$cari%");
                  });
        }
        $jadwals = $query->paginate(10);
        $dokters = Dokter::all();
        return view('jadwal.index', compact('jadwals', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required',
            'hari' => 'required',
            'poliklinik' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        JadwalDokter::create($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal praktik dokter berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('jadwal.index')->with('success', 'Jadwal praktik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        JadwalDokter::findOrFail($id)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Jadwal praktik berhasil dihapus!');
    }
}