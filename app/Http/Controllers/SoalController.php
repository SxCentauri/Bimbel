<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Soal;
use App\Models\Ujian;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $soals = Soal::all();
        return view('soal.index', compact('soals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Ujian $ujian)
    {
         return view('soal.create', compact('ujian') );

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Ujian $ujian)
    {
         $data = $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required'
        ]);

        $ujian->soals()->create($data);
        return redirect()
            ->route('ujian.show', $ujian->id)
            ->with('success', 'Soal berhasil ditambahkan');

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
    public function show(soal $soal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ujian $ujian, Soal $soal)
    {
        return view('soal.edit', compact('ujian', 'soal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ujian $ujian, Soal $soal)
    {
        $data = $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required'
        ]);
        $soal->update($data);

     return redirect()
    ->route('ujian.show', ['ujian' => $ujian->id])
    ->with('success', 'Soal berhasil diupdate');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ujian $ujian, Soal $soal)
    {
        $soal->delete();

        return redirect()
            ->route('ujian.show', $ujian->id)
            ->with('success', 'Soal berhasil dihapus');
    }
        /**
     * Import soal from Excel file.
     */

    public function importExcel(Request $request, Ujian $ujian)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls,csv|max:2048',
    ]);

    $spreadsheet = IOFactory::load($request->file('file')->getRealPath());
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    $header = array_map(fn($h) => strtolower(trim($h)), $rows[0]);
    unset($rows[0]);

    $count = 0;

    foreach ($rows as $row) {
        if (count($row) !== count($header)) continue;

        $data = array_combine($header, $row);

        // 🔥 PAKSA TEKS BERSIH (INI KUNCINYA)
        $pertanyaan = strip_tags($data['soal'] ?? '');
        $pertanyaan = preg_replace('/text-align\s*:\s*center;?/i', '', $pertanyaan);
        $pertanyaan = '<div style="text-align:left">' . $pertanyaan . '</div>';

        Soal::create([
            'ujian_id'       => $ujian->id,
            'pertanyaan'    => $pertanyaan,
            'opsi_a'        => strip_tags($data['a'] ?? ''),
            'opsi_b'        => strip_tags($data['b'] ?? ''),
            'opsi_c'        => strip_tags($data['c'] ?? ''),
            'opsi_d'        => strip_tags($data['d'] ?? ''),
            'jawaban_benar' => strtoupper($data['kunci'] ?? ''),
        ]);

        $count++;
    }

    return back()->with('success', "$count soal berhasil diimport");
}

}
