<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use App\Models\Hasil;
use Illuminate\Http\Request;

class GuruUjianController extends Controller
{
    /**
     * Menampilkan daftar ujian (Versi Guru)
     */
    public function index(Request $request)
    {
        $query = Ujian::query();

        // Fitur Pencarian
        if ($request->has('q') && $request->q != '') {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('nama_ujian', 'like', "%{$search}%")
                  ->orWhere('mapel', 'like', "%{$search}%")
                  ->orWhere('kelas', 'like', "%{$search}%");
            });
        }

        // Ambil data terbaru, pagination 10
        $ujians = $query->latest()->paginate(10);
        $ujians->appends(['q' => $request->q]);

        // Menggunakan view khusus guru
        return view('guru.ujian.index', compact('ujians'));
    }

    /**
     * Form Tambah Ujian Baru
     */
    public function create()
    {
        return view('guru.ujian.create');
    }

    /**
     * Simpan Data Ujian Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian'      => 'required|string|max:255',
            'mapel'           => 'required|string|max:100',
            'kelas'           => 'required|string|max:50',
            'waktu_mulai'     => 'required|date',
            'waktu_selesai'   => 'required|date|after:waktu_mulai',
            'deskripsi'       => 'nullable|string',
        ]);

        Ujian::create([
            'nama_ujian'      => $request->nama_ujian,
            'mapel'           => $request->mapel,
            'kelas'           => $request->kelas,
            'deskripsi'       => $request->deskripsi,
            'waktu_mulai'     => $request->waktu_mulai,
            'waktu_selesai'   => $request->waktu_selesai,
            'acak_soal'       => $request->has('acak_soal') ? 1 : 0,
            'acak_jawaban'    => $request->has('acak_jawaban') ? 1 : 0,
            'tampilkan_hasil' => $request->has('tampilkan_hasil') ? 1 : 0,
        ]);

        return redirect()->route('guru.ujian.index')
            ->with('success', 'Ujian berhasil dibuat!');
    }

    /**
     * Lihat Detail Ujian (Show)
     */
    public function show($id)
    {
        $ujian = Ujian::with('soals')->findOrFail($id);
        return view('guru.ujian.show', compact('ujian'));
    }

    /**
     * Form Edit Ujian
     */
    public function edit($id)
    {
        $ujian = Ujian::findOrFail($id);
        return view('guru.ujian.edit', compact('ujian'));
    }

    /**
     * Update Data Ujian
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ujian'      => 'required|string|max:255',
            'mapel'           => 'required|string|max:100',
            'kelas'           => 'required|string|max:50',
            'waktu_mulai'     => 'required|date',
            'waktu_selesai'   => 'required|date|after:waktu_mulai',
            'deskripsi'       => 'nullable|string',
        ]);

        $ujian = Ujian::findOrFail($id);

        $ujian->update([
            'nama_ujian'      => $request->nama_ujian,
            'mapel'           => $request->mapel,
            'kelas'           => $request->kelas,
            'deskripsi'       => $request->deskripsi,
            'waktu_mulai'     => $request->waktu_mulai,
            'waktu_selesai'   => $request->waktu_selesai,
            'acak_soal'       => $request->has('acak_soal') ? 1 : 0,
            'acak_jawaban'    => $request->has('acak_jawaban') ? 1 : 0,
            'tampilkan_hasil' => $request->has('tampilkan_hasil') ? 1 : 0,
        ]);

        return redirect()->route('guru.ujian.index')
            ->with('success', 'Data ujian berhasil diperbarui!');
    }

    /**
     * Hapus Ujian
     */
    public function destroy($id)
    {
        $ujian = Ujian::findOrFail($id);
        $ujian->delete();

        return redirect()->route('guru.ujian.index')
            ->with('success', 'Ujian berhasil dihapus.');
    }

    /**
     * Toggle Status Ujian (Aktif/Nonaktif manual jika diperlukan nanti)
     * Untuk saat ini kita pakai toggle tampilkan_hasil saja via edit
     */
    public function toggle($id)
    {
        // Opsional: jika ingin fitur toggle cepat di index
    }

    /**
     * Lihat Hasil Siswa (Menu Hasil)
     */
    public function hasil($id)
    {
        $ujian = Ujian::findOrFail($id);
        
        // Ambil hasil ujian siswa, urutkan nilai tertinggi
        $hasils = Hasil::where('ujian_id', $id)
                    ->with('user')
                    ->orderBy('nilai', 'desc')
                    ->get();

        return view('guru.ujian.hasil', compact('ujian', 'hasils'));
    }

    /**
     * Reset Hasil Siswa (Agar bisa ujian ulang)
     */
    public function reset($id)
    {
        $hasil = Hasil::findOrFail($id);
        $hasil->delete();

        return back()->with('success', 'Nilai siswa berhasil direset. Siswa dapat mengerjakan ulang.');
    }
}