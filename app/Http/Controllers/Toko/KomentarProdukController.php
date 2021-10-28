<?php

namespace App\Http\Controllers\Toko;

use App\KomentarProduk;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mail;
use Auth;

class KomentarProdukController extends Controller
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
        $id_komentar_produk = 'komentproduk'.crc32(date('ymdhis'));

//        return $request->all();
        KomentarProduk::create([
            'id_komentar_produk' => $id_komentar_produk,
            'id_user' => $request->id_user,
            'id_produk' => $request->id_produk,
            'komentar' => $request->komentar,
            'kode_status' => $request->kode_status,
            'status' => $request->status,
        ]);

        $address = Auth::user()->email;

        $mail = array( 'name' => Auth::user()->nama_depan.' '.Auth::user()->nama_belakang );

        Mail::send('toko.mail.notif_komentar', $mail, function($message) use ($address){
            $message->to($address, 'member')->subject('Komentar Terkirim');
            $message->from('donotreply@cvbensonshop.masuk.id','donotreply@cvbensonshop.masuk.id');
        });


        return back()->with('alert','komentar kamu berhasil dikirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KomentarProduk  $komentarProduk
     * @return \Illuminate\Http\Response
     */
    public function show(KomentarProduk $komentarProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KomentarProduk  $komentarProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(KomentarProduk $komentarProduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KomentarProduk  $komentarProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KomentarProduk $komentarProduk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KomentarProduk  $komentarProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy(KomentarProduk $komentarProduk)
    {
        //
    }
}
