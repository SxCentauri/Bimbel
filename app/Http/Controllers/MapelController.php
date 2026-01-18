<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use App\Models\Mandiri;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Mandiri $mandiri)
    {
      $mapels = Mapel::all();
        return view('mandiri.index', compact('mapels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Mandiri $mandiri)
    {
        return view('mandiri.mapel', compact('mandiri'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request , Mandiri $mandiri)
    {
        $data = $request->validate([
            'pertanyaan' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
    ]);

    $mandiri->mapels()->create($data);

    return redirect()
        ->route('mandiri.show', $mandiri->id)
        ->with('success', 'Soal berhasil ditambahkan');

      
    }
public function importExcel(Request $request, Mandiri $mandiri)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:2048',
    ]);
    

    $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    // header baris pertama
    $header = array_map(fn ($h) => strtolower(trim($h)), $rows[0]);
    unset($rows[0]);

    $count = 0;

    foreach ($rows as $row) {
        if (count($row) !== count($header)) {
            continue;
        }

        $data = array_combine($header, $row);

        // 🔥 bersihkan soal
        $pertanyaan = strip_tags($data['soal'] ?? '');
        $pertanyaan = preg_replace('/text-align\s*:\s*center;?/i', '', $pertanyaan);
        $pertanyaan = '<div style="text-align:left">' . $pertanyaan . '</div>';

        $mandiri->mapels()->create([
            'pertanyaan' => $pertanyaan,
            'a' => strip_tags($data['a'] ?? ''),
            'b' => strip_tags($data['b'] ?? ''),
            'c' => strip_tags($data['c'] ?? ''),
            'd' => strip_tags($data['d'] ?? ''),
        ]);

        $count++;
    }

    return back()->with('success', "$count soal berhasil diimport");
}
public function upload(Request $request)
{
    if ($request->hasFile('upload')) {

        $path = $request->file('upload')->store('soal', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

    return response()->json([
        'error' => 'Upload gagal'
    ], 400);
}

    /**
     * Display the specified resource.
     */
    public function show(mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( mandiri $mandiri, mapel $mapel)
    {
       

        return view('mandiri.edit', compact('mandiri', 'mapel'));
    }

        

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mandiri $mandiri, mapel $mapel)
    {
        $data = $request->validate([
            'pertanyaan' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            
        ]);
        $mapel->update($data);

     return redirect()
    ->route('mandiri.show', ['mandiri' => $mandiri->id])
    ->with('success', 'Soal berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mandiri $mandiri, mapel $mapel)
    { 
        $mapel->delete();

        return redirect()
            ->route('mandiri.show', $mandiri->id)
            ->with('success', 'Soal berhasil dihapus');
    }
}
