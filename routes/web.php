<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\soalController;
use App\Http\Controllers\JawabanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\MandiriController;
use App\Http\Controllers\tryoutController;
use App\Http\Controllers\UjianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/soal', function () {
    return view('index.soal');
})->name('index.soal');

Route::get('/belajar', function () {
    return view('belajar');
})->name('belajar');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');

Route::get('/tryout', function () {
    return view('tryout.tryout');
})->name('tryout.tryout');



Route::resource('home', HomeController::class);

Route::get('/mandiri/{mandiri}', [HomeController::class, 'show'])->name('index.show');


    Route::get('/mandiri/{mandiri}/lihat-soal', [HomeController::class, 'lihat'])
    ->name('index.lihat-soal');

Route::get('/soal', [HomeController::class, 'index'])
    ->name('index.soal');

Route::middleware(['auth', 'role:guru'])->group(function () {

    /* Dashboard role guru */
        Route::get('/mandiri', [MandiriController::class, 'home'])
        ->name('mandiri.latihan'); 

        Route::resource('ujian', UjianController::class);
        
        Route::get('/ujian/{ujian}', [UjianController::class, 'show'])
            ->name('ujian.show');

        Route::get('ujian/{ujian}/soal/create', [SoalController::class, 'create'])
            ->name('soal.create');

        Route::get('/ujian/{ujian}/edit', [UjianController::class, 'edit'])->name('ujian.edit');
        Route::get('/ujian/{ujian}/update', [UjianController::class, 'edit'])->name('ujian.show');
        Route::put('/ujian/{ujian}', [UjianController::class, 'update'])->name('ujian.update');
        Route::post('/ujian/{ujian}/toggle', [UjianController::class, 'toggle'])
        ->name('ujian.toggle');


        Route::post('ujian/{ujian}/soal', [SoalController::class, 'store'])
            ->name('soal.store');

        Route::post('soal/upload', [SoalController::class, 'upload'])
            ->name('soal.upload');



        Route::post('/ujian/{ujian}/soal', [SoalController::class, 'store'])->name('soal.store');

        Route::post('/ujian/{ujian}/soal/import-excel',
            [SoalController::class, 'importExcel'])->name('soal.import.excel');

        
                Route::resource('mandiri', MandiriController::class);
        Route::get('mandiri/{mandiri}/mandiri/mapel', [MapelController::class, 'create'])
                ->name('mandiri.mapel');
        Route::get('/mapel/create/{mandiri}', [MapelController::class, 'create'])
            ->name('mandiri.mapel');

        Route::post('/mandiri/{mandiri}/mapel', [MapelController::class, 'store'])
            ->name('mapel.store');

        Route::post('/mandiri/{mandiri}/mapel/import', 
            [MapelController::class, 'importExcel']
        )->name('mapel.import');
        // tampilkan form edit
        Route::get('/mandiri/{mandiri}/mapel/{mapel}/edit', [MapelController::class, 'edit'])
            ->name('mapel.edit');

        // proses update
        Route::put('/mandiri/{mandiri}/mapel/{mapel}', [MapelController::class, 'update'])
            ->name('mapel.update');
        // proses delete
        Route::delete('/mandiri/{mandiri}/mapel/{mapel}', [MapelController::class, 'destroy'])
            ->name('mapel.destroy');

        Route::get('/dashboard/akun-guru', [AuthController::class, 'akunguru'])
    ->name('akun-guru');

    Route::get('/mandiri', [MandiriController::class, 'index'])
    ->name('mandiri.materi');
    Route::post('/dashboard/akun-guru', [AuthController::class, 'storeGuru'])->name('storeguru');


});




// siswa
Route::get('/tryout', [TryoutController::class, 'index'])
    ->name('tryout')
    ->middleware(['auth', 'role:siswa']);

// guru
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'role:guru']);

//Route::get('/ujian', [UjianController::class, 'index'])->name('ujian');

// route untuk login dan logout

Route::middleware(['auth', 'role:guru'])->group(function () {
  
});


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'loginProses'])->name('loginProses');

// route untuk daftar/register
Route::get('/daftar', [AuthController::class, 'daftar'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'daftarProses'])->name('daftarProses');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/ujian/{ujian}/soal/{soal}/edit', [SoalController::class, 'edit'])->name('soal.edit');
Route::put('/ujian/{ujian}/soal/{soal}', [SoalController::class, 'update'])->name('soal.update');
Route::delete('/ujian/{ujian}/soal/{soal}', [SoalController::class, 'destroy'])->name('soal.destroy');

Route::post('/mandiri/latihan/import', [MandiriController::class, 'import']);


Route::middleware(['auth','role:siswa'])->group(function () {
    Route::get('/tryout', function () {
    return view('tryout.tryout');
})->name('tryout.tryout');

    Route::get('/tryout', [tryoutController::class, 'index'])
    ->name('tryout.index');

    Route::get('/tryout/{ujian}', [tryoutController::class, 'show'])
    ->name('tryout.show');

   // benar-benar mulai mengerjakan
    Route::get('/tryout/mulai', [tryoutController::class, 'mulai'])
        ->name('tryout.mulai');

        Route::post('/jawaban/store', [TryoutController::class, 'store'])
    ->middleware('auth');

   Route::get('/tryout/{ujian}/kerjakan/{index?}', [TryoutController::class, 'kerjakan'])
    ->name('tryout.kerjakan');
  
    // Simpan jawaban sementara
Route::post('/tryout/jawab', [JawabanController::class, 'jawab'])
    ->name('tryout.jawab');

// Akhiri ujian dan tampilkan hasil
Route::post('/tryout/{ujian}/selesai', [JawabanController::class, 'selesai'])
    ->name('tryout.selesai');




});

Route::get('/tryout/{ujian}/hasil', [HasilController::class, 'hasil'])
    ->name('tryout.hasil');

Route::get('/tryout/{ujian}/reset', [TryoutController::class, 'reset'])
    ->name('tryout.reset');

Route::post('/ujian/keluar', [TryoutController::class, 'keluar'])
    ->name('ujian.keluar');

    Route::middleware('auth')->post('/ujian/pelanggaran', 
    [TryoutController::class, 'pelanggaran']
)->name('ujian.pelanggaran');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/tryout/{ujian}/{index}', [TryoutController::class, 'kerjakan'])
        ->name('tryout.kerjakan');
});


Route::middleware(['auth', 'cek.ujian.selesai'])->group(function () {

    Route::get('/tryout/{ujian}/kerjakan/{index}', 
        [TryoutController::class, 'kerjakan']
    )->name('tryout.kerjakan');

});

//Route::resource('ujian', DetailController::class);

//Route::get('/ujian', [UjianController::class, 'index'])->name('ujian.index');

//Route::post('/ujian', [UjianController::class, 'store'])->name('ujian.store');

