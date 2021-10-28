<?php

namespace App\Http\Controllers;

use App\Produk;
use App\GambarProduk;
use App\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
        $produk_all = Produk::join('kategoris', 'produks.id_kategori', '=', 'kategoris.id_kategori')->get('*');
        $title = 'Semua Produk';
        return view('admin.produk.index', ['produk_all' => $produk_all, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $kategori_all = Kategori::all();
        $title = 'Tambah Produk';
        return view('admin.produk.create', ['title' => $title, 'kategori_all' => $kategori_all]);
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
        $get_id = date('ymdhis');
        $next_id = 'p'.crc32($get_id);
             
        $this->validate($request, [
            'nama_produk' => 'required',
            'harga' => 'required|min:3',
            'stok' => 'required|min:1',
            'gambar' => 'required|file|image|max:3000',
            'deskripsi' => 'required',
            'id_kategori' => 'required',
        ]);

        $img = $request->file('gambar'); 
        $destinationpath = 'img/produk/'.$next_id.'/';
        $img_name = $img->getClientOriginalName(); 
        $path = $img->move($destinationpath, $img_name);
        
        Produk::create([
            'id_produk' => $next_id,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $path,
            'deskripsi' => $request->deskripsi,
            'id_kategori' => $request->id_kategori,
        ]);

        if($request->hasfile('path'))
         {

            foreach($request->file('path') as $image)
            {
                $img_produk_name = $image->getClientOriginalName();
                $path_img_produk = $image->move($destinationpath, $img_produk_name);  
                //$data[] = $img_produk_name;
                GambarProduk::create([
                  'path' => $path_img_produk,
                  'id_produk'  => $next_id,  
                ]);  
            }
         }

        return redirect()->route('admin/produk')->with('success', 'Berhasil menambah produk baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $title = "Detail Produk";
        $produk_detail = Produk::join('kategoris', 'produks.id_kategori', '=', 'kategoris.id_kategori')->find($id);
        $gambar_produk = GambarProduk::where('id_produk',$id)->get();
        return view('admin/produk/detail',['produk_detail' => $produk_detail, 'gambar_produk' => $gambar_produk, 'title' => $title]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
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
}
