<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use App\Models\Soal;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class GuruSoalController extends Controller
{
    /**
     * Form Tambah Soal (Guru)
     */
    public function create($ujian_id)
    {
        $ujian = Ujian::findOrFail($ujian_id);
        // Arahkan ke view guru
        return view('guru.soal.create', compact('ujian'));
    }

    /**
     * Simpan Soal Baru
     */
    public function store(Request $request, $ujian_id)
    {
        $ujian = Ujian::findOrFail($ujian_id);

        $request->validate([
            'pertanyaan'    => 'required',
            'opsi_a'        => 'required',
            'opsi_b'        => 'required',
            'opsi_c'        => 'required',
            'opsi_d'        => 'required',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $ujian->soals()->create([
            'pertanyaan'    => $request->pertanyaan,
            'opsi_a'        => $request->opsi_a,
            'opsi_b'        => $request->opsi_b,
            'opsi_c'        => $request->opsi_c,
            'opsi_d'        => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()->route('guru.ujian.show', $ujian->id)
            ->with('success', 'Soal berhasil ditambahkan');
    }

    /**
     * Form Edit Soal
     */
    public function edit($id)
    {
        $soal = Soal::with('ujian')->findOrFail($id);
        $ujian = $soal->ujian;
        return view('guru.soal.edit', compact('soal', 'ujian'));
    }

    /**
     * Update Soal
     */
    public function update(Request $request, $id)
    {
        $soal = Soal::findOrFail($id);

        $request->validate([
            'pertanyaan'    => 'required',
            'opsi_a'        => 'required',
            'opsi_b'        => 'required',
            'opsi_c'        => 'required',
            'opsi_d'        => 'required',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $soal->update([
            'pertanyaan'    => $request->pertanyaan,
            'opsi_a'        => $request->opsi_a,
            'opsi_b'        => $request->opsi_b,
            'opsi_c'        => $request->opsi_c,
            'opsi_d'        => $request->opsi_d,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()->route('guru.ujian.show', $soal->ujian_id)
            ->with('success', 'Soal berhasil diperbarui');
    }

    /**
     * Hapus Soal
     */
    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $ujian_id = $soal->ujian_id;
        $soal->delete();

        return redirect()->route('guru.ujian.show', $ujian_id)
            ->with('success', 'Soal berhasil dihapus');
    }

    /**
     * Upload Gambar CKEditor (Guru)
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $filename . '_' . time() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('soal_images', $filename, 'public');

            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => ['message' => 'Upload gagal']], 400);
    }

    public function importExcel(Request $request, $ujian_id)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        $ujian = Ujian::findOrFail($ujian_id);

        try {
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet       = $spreadsheet->getActiveSheet();
            $rows        = $sheet->toArray();

            // Asumsi Baris 1 adalah Header, jadi kita hapus
            // Header harusnya: [Soal, A, B, C, D, Jawaban]
            $header = array_map(fn($h) => strtolower(trim($h ?? '')), $rows[0]);
            unset($rows[0]);

            $count = 0;
            
            // Tag HTML yang diperbolehkan (agar format bold/italic tidak hilang jika ada di excel)
            $allowed_tags = '<p><br><b><i><u><strong><em><span><div><ul><ol><li><table><tr><td><th><tbody><thead><img>';

            foreach ($rows as $row) {
                // Pastikan baris memiliki jumlah kolom yang cukup
                if (count($row) < 6) continue;

                // Mapping data berdasarkan indeks kolom (0=Soal, 1=A, 2=B, 3=C, 4=D, 5=Jawaban)
                // Jika ingin lebih dinamis bisa pakai array_combine dengan header, tapi ini cara paling aman.
                
                $pertanyaan = trim($row[0] ?? '');
                $opsi_a     = trim($row[1] ?? '');
                $opsi_b     = trim($row[2] ?? '');
                $opsi_c     = trim($row[3] ?? '');
                $opsi_d     = trim($row[4] ?? '');
                $jawaban    = strtoupper(trim($row[5] ?? 'A')); // Default A

                // Skip jika pertanyaan kosong
                if (empty($pertanyaan)) continue;

                // Validasi Jawaban (Harus A, B, C, atau D)
                if (!in_array($jawaban, ['A', 'B', 'C', 'D'])) {
                    $jawaban = 'A'; 
                }

                // Bungkus pertanyaan dengan <p> jika belum ada tag HTML (supaya rapi di CKEditor)
                if ($pertanyaan != strip_tags($pertanyaan)) {
                    // Sudah ada HTML, biarkan (bersihkan tag berbahaya saja)
                    $pertanyaan = strip_tags($pertanyaan, $allowed_tags);
                } else {
                    // Teks polos, bungkus <p>
                    $pertanyaan = '<p>' . $pertanyaan . '</p>';
                }

                $ujian->soals()->create([
                    'pertanyaan'    => $pertanyaan,
                    'opsi_a'        => strip_tags($opsi_a, $allowed_tags),
                    'opsi_b'        => strip_tags($opsi_b, $allowed_tags),
                    'opsi_c'        => strip_tags($opsi_c, $allowed_tags),
                    'opsi_d'        => strip_tags($opsi_d, $allowed_tags),
                    'jawaban_benar' => $jawaban,
                ]);

                $count++;
            }

            return back()->with('success', "Berhasil mengimport $count soal.");

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}