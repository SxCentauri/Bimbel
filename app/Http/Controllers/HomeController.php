<?php

namespace App\Http\Controllers;

use App\Models\home;
use App\Models\mandiri;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mandiri = mandiri::all();
        return view('index.soal', compact('mandiri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(home $home)
    {
        return view('home.show', compact('home'));
    }

    public function lihat(Mandiri $mandiri, $index = 0)
{
    $mapel = $mandiri->mapels()->orderBy('id')->get();

    if ($mapel->isEmpty()) {
        return redirect()->back()->with('error', 'Mapel ini belum memiliki soal.');
    }

    return view('index.lihat-soal', compact('mandiri', 'mapel'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(home $home)
    {
        //
    }
}
