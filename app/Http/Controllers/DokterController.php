<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    // Menampilkan data dokter + fitur pencarian & pagination
    public function index(Request $request)
    {
        // Menangkap parameter pencarian dari input (mendukung 'cari' maupun 'search')
        $search = $request->input('cari') ?? $request->input('search');
        
        $dokters = Dokter::when($search, function ($query, $search) {
            return $query->where('nama_lengkap', 'like', "%{$search}%")
                         ->orWhere('spesialisasi', 'like', "%{$search}%")
                         ->orWhere('no_telepon', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('dokter.index', compact('dokters', 'search'));
    }

    // Menyimpan data dokter baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:15',
            'jam_praktik' => 'required|string|max:100',
        ]);

        Dokter::create($request->all());

        return redirect()->route('dokter.index')->with('success', 'Data dokter baru berhasil ditambahkan!');
    }

    // Menampilkan form edit dokter
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokters = Dokter::latest()->paginate(10);

        return view('dokter.index', compact('dokter', 'dokters'));
    }

    // Memperbarui data dokter
    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:100',
            'no_telepon' => 'required|string|max:15',
            'jam_praktik' => 'required|string|max:100',
        ]);

        $dokter->update($request->all());

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui!');
    }

    // Menghapus data dokter
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus!');
    }
}