<?php

namespace App\Http\Controllers;

use App\Models\Mandiri;
use App\Models\Mapel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;

class MandiriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mandiris = Mandiri::all();
        return view('mandiri.materi', compact('mandiris'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $header = array_map(fn($h) => strtolower(trim($h)), $rows[0]);
        unset($rows[0]);

        $soals = [];

        foreach ($rows as $row) {
            if (count($row) !== count($header)) continue;

            $data = array_combine($header, $row);

            $soals[] = [
                'pertanyaan' => strip_tags($data['soal'] ?? ''),
                'a' => strip_tags($data['a'] ?? ''),
                'b' => strip_tags($data['b'] ?? ''),
                'c' => strip_tags($data['c'] ?? ''),
                'd' => strip_tags($data['d'] ?? ''),
            ];
        }

        // LANGSUNG kirim ke view (tidak session, tidak DB)
        return view('mandiri.latihan', compact('soals'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mandiri.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'nama_mapel' => 'required|string|max:100',
        ]);

        Mandiri::create([
            'nama_mapel' => $request->nama_mapel,
        ]);

        return redirect()->back()
            ->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mandiri $mandiri)
    {
          return view('mandiri.show', compact('mandiri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mandiri $mandiri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mandiri $mandiri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mandiri $mandiri)
    {
        $mandiri->delete();
         return redirect()->route('mandiri.materi')
            ->with('success', 'Mapel dan semua soal berhasil dihapus');
    }
}
