<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Models\Hasil;
use App\Models\Jawaban;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::withCount('soals')->latest()->get();
        return view('ujian.index', compact('ujians'));
    }

    public function create()
    {
        return view('ujian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'mapel' => 'required|string',
            'kelas' => 'required|string',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
        ]);

        Ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'deskripsi' => $request->deskripsi,
            'acak_soal' => $request->has('acak_soal'),
            'acak_jawaban' => $request->has('acak_jawaban'),
            'tampilkan_hasil' => $request->has('tampilkan_hasil'),
            'waktu_mulai' => $request->filled('waktu_mulai') 
                ? Carbon::parse($request->waktu_mulai) 
                : null,
            'waktu_selesai' => $request->filled('waktu_selesai') 
                ? Carbon::parse($request->waktu_selesai) 
                : null,
        ]);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil disimpan');
    }

    public function show(Ujian $ujian)
    {
        $jumlahSoal = $ujian->soals()->count();
        return view('ujian.show', compact('ujian', 'jumlahSoal'));
    }

    public function edit(Ujian $ujian)
    {
        return view('ujian.edit', compact('ujian'));
    }

    public function update(Request $request, Ujian $ujian)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'mapel' => 'required|string',
            'kelas' => 'required|string',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
        ]);

        $ujian->update([
            'nama_ujian' => $request->nama_ujian,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'deskripsi' => $request->deskripsi,
            'acak_soal' => $request->has('acak_soal'),
            'acak_jawaban' => $request->has('acak_jawaban'),
            'tampilkan_hasil' => $request->has('tampilkan_hasil'),
            'waktu_mulai' => $request->filled('waktu_mulai') 
                ? Carbon::parse($request->waktu_mulai) 
                : null,
            'waktu_selesai' => $request->filled('waktu_selesai') 
                ? Carbon::parse($request->waktu_selesai) 
                : null,
        ]);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil diperbarui');
    }

    public function destroy(Ujian $ujian)
    {
        $ujian->delete();
        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dihapus');
    }

    public function hasil(Ujian $ujian)
    {
        $hasils = Hasil::with('user')
            ->where('ujian_id', $ujian->id)
            ->orderByDesc('skor')
            ->get();

        return view('ujian.hasil', compact('ujian', 'hasils'));
    }

    public function reset($id)
    {
        $hasil = Hasil::findOrFail($id);

        Jawaban::where('user_id', $hasil->user_id)
            ->where('ujian_id', $hasil->ujian_id)
            ->delete();

        $hasil->delete();

        return back()->with('success', 'Ujian siswa berhasil di-reset.');
    }
}