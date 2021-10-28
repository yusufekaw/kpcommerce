<?php

namespace App\Http\Controllers\Admin;

use App\GambarProduk;
use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;
use File;
use Auth;

class GambarProdukController extends Controller
{
    protected $redirectTo = '/admin';
    
    public function __construct()
    {
        $this->middleware('auth');        
    }
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
        $this->validate($request, [
            'path' => 'required|file|image|max:3000',
        ]);

        $id_produk = $request->id_produk;
        $id_gambar = '_g'.crc32(date('ymdhis'));

        //$gambar = GambarProduk::where('id_produk',$request->id_produk);
        //$id_produk = $gambar->id_produk;
        $image = $request->file('path');
        $destinationpath = 'img/produk/'.$id_produk.'/';
        $ext_img = $image->getClientOriginalExtension();
        $img_produk_name = $id_produk.''.$id_gambar.'.'.$ext_img;
                
        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_produk_name));
                
        GambarProduk::create([
            'id_gambar' => 'p'.$request->id_produk.''.$id_gambar,  
            'path' => $destinationpath.''.$img_produk_name,
            'id_produk'  => $request->id_produk,  
        ]);

        return back()->with('success', 'berhasil menambah gambar deskripsi produk');

        //return $request->all();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function show(GambarProduk $gambarProduk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function edit(GambarProduk $gambarProduk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //$img_produk_name = $image->getClientOriginalName();
        $gambar = GambarProduk::find($id);
        $id_produk = $gambar->id_produk;
        
        $this->validate($request, [
            'path' => 'required|file|image|max:3000',
        ]);

        $image = $request->file('path');
        $destinationpath = 'img/produk/'.$id_produk.'/';
        $ext_img = $image->getClientOriginalExtension();
        $img_produk_name = $id.'.'.$ext_img;
                
        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_produk_name));
                
                //$path_img_produk = $image->move($destinationpath, $img_produk_name);  
                //$data[] = $img_produk_name;
        /*GambarProduk::create([
            'path' => $destinationpath.''.$img_produk_name,
            'id_produk'  => $next_id,  
        ]);*/
        $gambar->update([
            'path' => $destinationpath.''.$img_produk_name 
        ]);
        return back()->with('success', 'berhasil mengubah gambar deskripsi produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GambarProduk  $gambarProduk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        $gambarproduk = GambarProduk::find($id);
        $gambarproduk->delete();
        return back()->with('success', 'berhasil menghapus gambar deskripsi produk');
    }
}
