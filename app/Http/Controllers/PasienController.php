<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = Pasien::latest();

        if ($request->has('cari') && $request->cari != '') {
            $cari = $request->cari;
            $query->where('nama_lengkap', 'like', "%$cari%")
                  ->orWhere('nik', 'like', "%$cari%")
                  ->orWhere('no_telepon', 'like', "%$cari%");
        }

        $pasiens = $query->paginate(10);

        return view('pasien.index', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:pasiens,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string',
            'keluhan' => 'nullable|string',
        ]);

        // Simpan dengan pemetaan kolom database yang akurat
        Pasien::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telp ?? '-', // Dipetakan ke kolom no_telepon
            'keluhan' => $request->keluhan ?? '-',       // Disimpan ke kolom keluhan
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data pasien baru beserta keluhan awal berhasil didaftarkan!');
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);
        
        $request->validate([
            'nik' => 'required|string|size:16|unique:pasiens,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
            'no_telp' => 'nullable|string',
            'keluhan' => 'nullable|string',
        ]);

        $pasien->update([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telp ?? '-',
            'keluhan' => $request->keluhan ?? '-',
        ]);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pasien::findOrFail($id)->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}