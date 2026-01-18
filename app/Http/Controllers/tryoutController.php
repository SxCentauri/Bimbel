<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Ujian;
use Carbon\Carbon;
use App\Models\Hasil;
use App\Models\Soal;
use App\Models\Jawaban;



class tryoutController extends Controller
{
     public function index() 
    {
        $ujian = Ujian::all();

        
       $now = now();

        foreach ($ujian as $item) {
            $item->bisa_dikerjakan =
                $item->waktu_mulai &&
                $item->waktu_selesai &&
                $now->between($item->waktu_mulai, $item->waktu_selesai);
        }

        return view('tryout.tryout', compact('ujian'));
    }

    public function show()
    {
        return view('tryout.show');
    }
        

 public function kerjakan(Ujian $ujian, $index)
{
    $hasil = Hasil::where('user_id', Auth::id())
        ->where('ujian_id', $ujian->id)
        ->first();

    if ($hasil && $hasil->selesai) {
        return redirect()->route('tryout.hasil', $ujian->id)
            ->with('warning', 'Anda sudah menyelesaikan ujian ini.');
    }

    $soal_list = $ujian->soals()->get();
    $soal = $soal_list[$index];

    $jawaban_user = Jawaban::where('user_id', Auth::id())
        ->where('ujian_id', $ujian->id)
        ->where('soal_id', $soal->id) // 🔥 INI KUNCINYA
        ->first();
    $jawaban_all = Jawaban::where('user_id', Auth::id())
    ->where('ujian_id', $ujian->id)
    ->pluck('jawaban', 'soal_id'); // soal_id => jawaban


    return view('tryout.kerjakan', compact(
        'ujian',
        'soal_list',
        'soal',
        'index',
        'jawaban_user',
        'jawaban_all'
    ));
}

public function akhiri(Ujian $ujian)
{
    $nilai = 0; // hitung nilai di sini

    $hasil = Hasil::updateOrCreate(
        [
            'user_id' => Auth::id(),
            'ujian_id' => $ujian->id,
        ],
        [
            'nilai' => $nilai,
            'selesai' => true
        ]
    );

    return redirect()->route('tryout.hasil', $ujian->id);
}



public function pelanggaran(Request $request)
{
    $hasil = Hasil::where('user_id', Auth::id())
        ->where('ujian_id', $request->ujian_id)
        ->first();

    if (!$hasil || $hasil->status === 'selesai') {
        return response()->json(['status' => 'selesai']);
    }

    $hasil->peringatan += 1;

    // RESET JAWABAN
    Jawaban::where('hasil_id', $hasil->id)->delete();

    if ($hasil->peringatan >= 3) {
        $hasil->status = 'selesai';
        $hasil->save();

        return response()->json(['status' => 'selesai']);
    }

    $hasil->save();

    return response()->json([
        'status' => 'peringatan',
        'peringatan' => $hasil->peringatan
    ]);
}


}