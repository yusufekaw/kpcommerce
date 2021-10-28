<?php

namespace App\Http\Controllers\Admin;

use App\LokasiToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LokasiTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LokasiToko  $lokasiToko
     * @return \Illuminate\Http\Response
     */
    public function show(LokasiToko $lokasiToko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LokasiToko  $lokasiToko
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiToko $lokasiToko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LokasiToko  $lokasiToko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $lokasitoko = LokasiToko::find('1');
        $lokasitoko->update($request->all());
        return back()->with('success', 'berhasil memperbarui alamat toko');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LokasiToko  $lokasiToko
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $lokasitoko = LokasiToko::find('1');
        $lokasitoko->update([
            'jalan' => null,
            'rt' => null, 
            'rw' => null, 
            'kelurahan' => null, 
            'kecamatan'=> null, 
            'kota' => null, 
            'provinsi' => null, 
            'kodepos' => null,
            'latitude' => null,
            'longitude' => null,
        ]);
        return back()->with('success', 'berhasil memperbarui alamat toko');
    }
}
