<?php

namespace App\Http\Controllers\Toko;

use App\ProdukRating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukRatingController extends Controller
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
        $id_rating = 'rate'.crc32(date('ymdhis'));
        ProdukRating::create([
            'id_rating' => $id_rating,
            'id_user' => $request->id_user,
            'id_produk' => $request->id_produk,
            'nilai' => $request->rating,
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProdukRating  $produkRating
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukRating $produkRating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProdukRating  $produkRating
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdukRating $produkRating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProdukRating  $produkRating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdukRating $produkRating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProdukRating  $produkRating
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukRating $produkRating)
    {
        //
    }
}
