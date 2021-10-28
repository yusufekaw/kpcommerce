<?php

namespace App\Http\Controllers\Toko;

use App\Keranjang;
use App\Produk;
use App\Halaman;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class KeranjangController extends Controller
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
        $data['title'] = $toko->nama_toko.' | Keranjang belanja ';
        if(Auth::user())
        {
            $data['halaman'] = Halaman::all();
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
            return view('toko.keranjang.index', compact('data'));
        }
        else
        {
            return redirect('/');
        }
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
    public function store($id)
    {
        //
        //cari produk
        $produk = Produk::find($id);
        //apakah produk sudah dimasukkan keranjang oleh user?
        $ada_di_keranjang =Keranjang::where('id_keranjang','kj'.Auth::user()->id_user.''.$id)->get();
        //jika ada
        //tambah quantity
        if($ada_di_keranjang->count()>0)
        {
            $add = Keranjang::find('kj'.Auth::user()->id_user.''.$id);
            $add->update([
                'qty' => $add->qty+1,
                'total_harga' => $produk->harga * ($add->qty+1),
                'berat_total' => $produk->berat * ($add->qty+1),
            ]);
        }
        //jika tidak
        //masukkan produk ke keranjang
        else
        {
            Keranjang::create([
                'id_keranjang' => 'kj'.Auth::user()->id_user.''.$id,
                'id_produk' => $id,
                'id_user' => Auth::user()->id_user,
                'qty' => 1,
                'total_harga' => $produk->harga,
                'berat_total' => $produk->berat,
            ]);

        }

        //mencari produk yang baru saja di beli
        $produk_di_beli = $produk->nama_produk;
        //kembali ke home, memberi tahu user telah membeli sebuah produk
        return redirect('/')->with('alert', 'Kamu barusan beli '.$produk_di_beli );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $data = $request->all(); 
        foreach ($request->id_keranjang as $key => $value)
        {
            $id_updated = $data['id_keranjang'][$key];
            $id_produk = $data['id_produk'][$key];
            $qty = $data['qty'][$key];
            $harga = $data['harga'][$key];
            $berat = $data['berat'][$key];
            $catatan = $data['catatan'][$key];
            $total_harga = $data['harga'][$key] * $data['qty'][$key];
            $berat_total = $data['berat'][$key] * $data['qty'][$key];
            $to_updated = Keranjang::find($id_updated);
            $find_produk = Produk::find($id_produk);
            //echo $find_produk;
            $to_updated->update([
                'qty' => $qty,
                'total_harga' => $total_harga,  
                'catatan' => $catatan,  
                'berat_total' => $berat_total
            ]);    
        }

        return redirect('keranjang')->with('alert', 'berhasil mengupdate keranjang belanja');
        
    }

    //masukkan keranjang dari detail produk
    public function store2(Request $request)
    {
        //
        //mencari produk berdasarkan id
        $produk = Produk::find($request->id_produk);
        //jika pembelian melebihi stok 
        $nama_produk = $produk->nama_produk;
        $nama_produk = str_replace(' ','_',$nama_produk);
        if($request->qty>$request->max_qty)
        {
            //mengembalikan ke detail, memberikan peringatan user
            return redirect('produk/'.$request->id_produk.'/nama/'.$nama_produk)->with('alert','Kami gak punya stok sebanyak yang kamu mau. kurang dikit aja pasti ada!');
        }
        //jika pesanan terpenuhi
        else
        {     
            //apakah sudah ada di keranjang belanja
            $ada_di_keranjang =Keranjang::where('id_keranjang','kj'.Auth::user()->id_user.''.$request->id_produk)->get();
            //jika sudah ada
            //sambah quantity
            if($ada_di_keranjang->count()>0)
            {
                $add = Keranjang::find('kj'.Auth::user()->id_user.''.$request->id_produk);
                $add->update([
                    'qty' => $add->qty+$request->qty,
                    'total_harga' => $produk->harga * ($add->qty+$request->qty),
                    'berat_total' => $produk->berat * ($add->qty+$request->qty),
                 ]);
             }
             //jika tidak
             //masukkan produk ke keranjang
             else
             {
                 Keranjang::create([
                     'id_keranjang' => 'kj'.Auth::user()->id_user.''.$request->id_produk,
                     'id_produk' => $request->id_produk,
                     'id_user' => Auth::user()->id_user,
                     'qty' => $request->qty,
                     'total_harga' => $produk->harga,
                     'berat_total' => $produk->berat,
                 ]);
             }

             //mencari produk yang baru saja di beli
             $produk_di_beli = $produk->nama_produk;
             //kembali ke home, memberi tahu user telah membeli sebuah produk
            return redirect('produk/'.$request->id_produk.'/nama/'.$nama_produk)->with('alert','Kami barusan beli '.$produk->nama_produk);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //mencari keranjang belanja berdasarkan id
        $keranjang = Keranjang::find($id);
        //menghapus produk dari keranjang belanja
        $keranjang->delete();
        return back()->with('alert', '1 produk terhapus dari keranjang');
    }
}
