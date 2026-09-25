<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrean;
use App\Models\Pasien;
use App\Models\Dokter;

class AntreanController extends Controller
{
    /**
     * Tampilkan halaman utama manajemen antrean.
     */
    public function index(Request $request)
    {
        // Ambil data pasien dan dokter untuk pilihan dropdown
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        
        // Fitur Pencarian dengan orWhereHas yang aman dan valid
        $search = $request->input('cari');
        $antreans = Antrean::with(['pasien', 'dokter'])
            ->when($search, function ($query, $search) {
                return $query->where('no_antrean', 'like', "%{$search}%")
                             ->orWhereHas('pasien', function($q) use ($search) {
                                 $q->where('nama_lengkap', 'like', "%{$search}%")
                                   ->orWhere('nama_pasien', 'like', "%{$search}%");
                             });
            })
            ->latest()
            ->paginate(10);

        // Ambil pasien yang sedang aktif / diperiksa (Status: Dipanggil)
        $pasienAktif = Antrean::with(['pasien', 'dokter'])
            ->where('status', 'Dipanggil')
            ->first();

        // Buat nomor antrean otomatis berikutnya (Contoh: A-001, A-002, dst)
        $latestAntrean = Antrean::latest()->first();
        $nextNumber = $latestAntrean ? 'A-' . str_pad((int)substr($latestAntrean->no_antrean, 2) + 1, 3, '0', STR_PAD_LEFT) : 'A-001';

        // Kirim semua variabel yang dibutuhkan view secara lengkap
        return view('antrean.index', compact('pasiens', 'dokters', 'antreans', 'pasienAktif', 'nextNumber'));
    }

    /**
     * Simpan nomor antrean baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        // Generate nomor antrean otomatis terbaru saat disimpan
        $latestAntrean = Antrean::latest()->first();
        $nextNumber = $latestAntrean ? 'A-' . str_pad((int)substr($latestAntrean->no_antrean, 2) + 1, 3, '0', STR_PAD_LEFT) : 'A-001';

        Antrean::create([
            'no_antrean' => $nextNumber,
            'pasien_id' => $request->pasien_id,
            'dokter_id' => $request->dokter_id,
            'status' => 'Menunggu',
        ]);

        return redirect()->route('antrean.index')->with('success', 'Nomor antrean berhasil dicetak dan ditambahkan!');
    }

    /**
     * Ubah status antrean menjadi dipanggil.
     */
    public function panggil($id)
    {
        // Ubah status antrean lain yang tadinya dipanggil menjadi selesai
        Antrean::where('status', 'Dipanggil')->update(['status' => 'Selesai']);

        // Panggil antrean yang dipilih
        $antrean = Antrean::findOrFail($id);
        $antrean->update(['status' => 'Dipanggil']);

        return redirect()->route('antrean.index')->with('success', "Pasien dengan nomor {$antrean->no_antrean} sedang dipanggil ke ruang periksa.");
    }

    /**
     * Hapus data antrean.
     */
    public function destroy($id)
    {
        $antrean = Antrean::findOrFail($id);
        $antrean->delete();

        return redirect()->route('antrean.index')->with('success', 'Data antrean berhasil dihapus.');
    }
}