<?php

namespace App\Http\Controllers;

use App\Models\ujian;
use App\Models\soal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;


class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $ujians = Ujian::withCount('soals')->get();
        return view('ujian.index', compact('ujians'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ujian $ujian)
    {
        
        return view('ujian.create', compact('ujian'));
    

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         Ujian::create([
            'nama_ujian' => $request->nama_ujian,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'deskripsi' => $request->deskripsi,
            'acak_soal' => $request->has('acak_soal'),
            'acak_jawaban' => $request->has('acak_jawaban'),
            'tampilkan_hasil' => $request->has('tampilkan_hasil'),
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(ujian $ujian)
    {
         $jumlahSoal = $ujian->soals()->count();
         return view('ujian.show', compact('ujian', 'jumlahSoal'));
        
         

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ujian $ujian)
    {
          return view('ujian.edit', compact('ujian'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ujian $ujian)
    {

        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'mapel' => 'required|string',
            'kelas' => 'required|string',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after:waktu_mulai',
        ]);

        
        // tentukan status ujian otomatis
        $status = ($request->waktu_mulai && $request->waktu_selesai)
            ? 'terjadwal'
            : 'draft';

        $ujian->update([
            'nama_ujian' => $request->nama_ujian,
            'mapel' => $request->mapel,
            'kelas' => $request->kelas,
            'deskripsi' => $request->deskripsi,
            'acak_soal' => $request->has('acak_soal'),
            'acak_jawaban' => $request->has('acak_jawaban'),
            'tampilkan_hasil' => $request->has('tampilkan_hasil'),
                
            'waktu_mulai' => $request->filled('waktu_mulai')
                ? Carbon::createFromFormat('Y-m-d\TH:i', $request->waktu_mulai)
                : null,

            'waktu_selesai' => $request->filled('waktu_selesai')
                ? Carbon::createFromFormat('Y-m-d\TH:i', $request->waktu_selesai)
                : null,
]);


        return redirect()
            ->route('ujian.index')
            ->with('success', 'Ujian berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ujian $ujian)
    {
          
        $ujian->delete();
         return redirect()->route('ujian.index')
            ->with('success', 'Ujian dan semua soal berhasil dihapus');
    }

}
