<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ResepObatController extends Controller
{
    public function index(Request $request)
    {
        $query = Obat::latest();

        if ($request->has('cari') && $request->cari != '') {
            $cari = $request->cari;
            $query->where('nama', 'like', "%$cari%")
                  ->orWhere('kategori', 'like', "%$cari%")
                  ->orWhere('jenis', 'like', "%$cari%");
        }

        $obats = $query->paginate(10); // Menggunakan pagination

        return view('resep-obat.index', compact('obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string',
            'kategori' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Obat::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan ?? 'Obat standar klinik',
        ]);

        return redirect()->route('resep-obat.index')->with('success', 'Data obat baru berhasil ditambahkan ke inventaris apotek.');
    }

    public function destroy($id)
    {
        Obat::findOrFail($id)->delete();
        return redirect()->route('resep-obat.index')->with('success', 'Data obat berhasil dihapus dari sistem.');
    }
}