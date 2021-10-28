<?php

namespace App\Http\Controllers\Toko;

use App\Kategori;
use App\Produk;
use App\Halaman;
use App\Keranjang;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class KategoriController extends Controller
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
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id_kategori, $nama_kategori)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | kategori '.$nama_kategori;
        //deklarasi produk, menampilkan produk berdasarkan kategori
        $data['produk'] = Produk::where('id_kategori',$id_kategori)->paginate(12);
        //deklarasi variabel keranjang
        $data['keranjang'] = null;
        //jika user login menampilkan keranjang belanja
        if(Auth::user())
        {
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','Keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        }
        //deklarasi variabel halaman -> menampilkan menu halaman
        $data['halaman'] = Halaman::all();
        //deklarasi variabel kategori -> menampilkan sidebar kategori
        $data['kategori'] = Kategori::all();
        return view('toko.produk.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        //
    }
}
