<?php

namespace App\Http\Controllers\Toko;

use App\Halaman;
use App\Keranjang;
use App\Toko;
use App\LokasiToko;
use App\Bank;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class HalamanController extends Controller
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
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function show($id_halaman, $judul)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko;

        $data['keranjang'] = null;
        //jika user login menampilkan keranjang belanja
        if(Auth::user())
        {
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        }
        $data['halaman'] = Halaman::all();
        $data['halaman_detail'] = Halaman::find($id_halaman);
        return view('toko.halaman.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Halaman $halaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Halaman $halaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Halaman $halaman)
    {
        //
    }

    public function kontak()
    {
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['lokasi'] = LokasiToko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | kontak '.$toko->nama_toko;
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //deklarasi variabel keranjang
        $data['keranjang'] = null;
        //jika user login menampilkan keranjang belanja
        if(Auth::user())
        {
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        }
        //deklarasi variabel halaman -> menampilkan menu halaman
        $data['halaman'] = Halaman::all();
        
        return view('toko.halaman.kontak', compact('data'));

    }

    public function tentang()
    {
        //
         //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | tentang '.$toko->nama_toko;
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //deklarasi variabel keranjang
        $data['keranjang'] = null;
        //jika user login menampilkan keranjang belanja
        if(Auth::user())
        {
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        }
        //deklarasi variabel halaman -> menampilkan menu halaman
        $data['halaman'] = Halaman::all();
        $data['tentang'] = Toko::find('1');

        return view('toko.halaman.tentang', compact('data'));
    }
}
