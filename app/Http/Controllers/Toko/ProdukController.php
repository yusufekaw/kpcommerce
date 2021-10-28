<?php

namespace App\Http\Controllers\Toko;

use App\AlamatPelanggan;
use App\Pelanggan;
use App\AlamatUser;
use App\User;
use App\Produk;
use App\ProdukRating;
use App\GambarProduk;
use App\Kategori;
use App\Keranjang;
use App\Halaman;
use App\KomentarProduk;
use App\OrderItem;
use App\Toko;
use App\Bank;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | '.$toko->tagline ;
        //deklarasi variabel keranjang
        $data['keranjang'] = null;
        //jika user login menampilkan keranjang belanja
        if(Auth::user())
        {
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        }
        //deklarasi variabel halaman -> menampilkan menu halaman
        $data['halaman'] = Halaman::all();
        //deklarasi variabel kategori -> menampilkan sidebar kategori
        $data['kategori'] = Kategori::all();
        //deklarasi variabel kategori -> menampilkan data produk
        $data['produk'] = 
                        Produk::leftJoin('keranjangs','produks.id_produk','=','keranjangs.id_produk')
                        ->select(DB::raw('produks.id_produk as id_produk,produks.nama_produk as nama_produk, produks.stok as stok, SUM(keranjangs.qty) as qty, produks.harga as harga, produks.gambar as gambar'))
                        ->groupBy('produks.id_produk')
                        ->paginate(12);
        return view('toko.produk.index', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko;
        list($orderby, $ordertype) = explode(' ', $request->sort);
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
        //deklarasi variabel kategori -> menampilkan data produk
        $data['produk'] = 
                        Produk::leftJoin('keranjangs','produks.id_produk','=','keranjangs.id_produk')
                        ->select(DB::raw('produks.id_produk as id_produk,produks.nama_produk as nama_produk, produks.stok as stok, SUM(keranjangs.qty) as qty, produks.harga as harga, produks.gambar as gambar'))
                        ->orderby('produks.'.$orderby,$ordertype)
                        ->groupBy('produks.id_produk')
                        ->paginate(12);
        return view('toko.produk.index', compact('data'));
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
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id_produk, $nama_produk)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | '.$nama_produk;
        //deklarasi variabel keranjang
        $data['keranjang'] = null;
        $data['rating_count'] = 0;
        $data['order_count'] = 0;
        $data['rating_value'] = 0;
        //jika user login menampilkan keranjang belanja
        if(Auth::user())
        {
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','Keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        }
        //deklarasi variabel halaman -> menampilkan menu halaman
        $data['halaman'] = Halaman::all();
        //deklarasi variabel kategori -> menampilkan sidebar kategori
        $data['kategori'] = Kategori::all();
        //deklarasi variabel kategori -> menampilkan data produk
        $data['produk'] = Produk::find($id_produk);
        //deklarasi variabel kategori -> menampilkan data produk
        $data['di_keranjang'] = Keranjang::where('id_produk',$id_produk)->sum('qty');
        //deklarasi variabel gambar produk -> menampilkan gambar produk
        $data['gambar_produk'] = GambarProduk::where('id_produk',$id_produk)->get();
        //nampilin semua komentar di produk
        $data['komentar'] = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar'))
                            ->where('komentar_produks.id_produk',$id_produk)
                            ->orderBy('komentar_produks.created_at', 'DESC')
                            ->paginate(12);
        $data['rating_counter'] = ProdukRating::where('id_produk',$id_produk)->count();
        $data['rating_sum'] = ProdukRating::where('id_produk',$id_produk)->sum('nilai');
        if($data['rating_counter']==0)
        {
            $data['rating_value'] = 0; 
        }
        else
        {
            $data['rating_value'] = $data['rating_sum'] / $data['rating_counter'];
        }
        if(Auth::user())
        {
            $rating = ProdukRating::where('id_produk',$id_produk)->where('id_user',Auth::user()->id_user);
            $order = OrderItem::join('orders','orders.id_order','order_items.id_order')
                        ->where('id_produk',$id_produk)
                        ->where('id_user',Auth::user()->id_user);
            $data['rating_count'] = $rating->count();
            $data['order_count'] = $order->count();
        }
        if($data['produk']->stok>0)
        {            
            return view('toko.produk.detail', compact('data'));
        }
        else
        {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }

    public function search(Request $request)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | '.$request->keyword;
        $keyword = $request->keyword;

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
        //deklarasi variabel produk -> menampilkan data produk
        $data['produk'] = Produk::where('nama_produk', 'like', '%'.$keyword.'%')->paginate(12);
        return view('toko.produk.index', compact('data'));
    }
}
