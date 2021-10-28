<?php

namespace App\Http\Controllers\Toko;

use App\Order;
use App\OrderHistori;
use App\OrderItem;
use App\Keranjang;
use App\AlamatUser;
use App\Produk;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

Use Auth;

class CheckoutController extends Controller
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
        $data['title'] = $toko->nama_toko.' | Checkout';
        $id_order = 't'.date('ymdhis');
        $user = Auth::user()->id_user;
        $keranjang = Keranjang::where('id_user',$user)->get();
        Keranjang::where('id_user',$user)->delete();
        foreach($keranjang as $keranjang)
        {
            OrderItem::create([
                'id_order_item' => $keranjang->id_keranjang,
                'id_produk' => $keranjang->id_produk,
                'qty' => $keranjang->qty,
                'total' => $keranjang->total,
                'total' => $keranjang->berat,
                'catatan' => $keranjang->catatan,
                'id_order' => $id_order,
            ]);

            $min_stok = Produk::find($keranjang->id_produk);
            $stok_akhir = $min_stok->stok - $keranjang->qty;
            $min_stok->update([
                'stok' => $stok_akhir
            ]);
        }
        Order::create([
            'id_order' => $id_order,
            'id_user' => $user,
            'status' => 'dalam pemesanan',
        ]);

        

        return redirect('pengiriman/'.$id_order);

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
        $id_order = 't'.date('ymdhis');
        $user = Auth::user()->id_user;
        $keranjang = Keranjang::where('id_user',$user)->get();
        Keranjang::where('id_user',$user)->delete();
        
        $keranjang = $request->all(); 

        foreach ($request->id_keranjang as $key => $value)
        {
            $id_keranjang = $keranjang['id_keranjang'][$key];
            $id_produk = $keranjang['id_produk'][$key];
            $qty = $keranjang['qty'][$key];
            $catatan = $keranjang['catatan'][$key];

            $produk = Produk::find($id_produk);
            $harga_produk = $produk->harga;

            OrderItem::create([
                'id_order_item' => 'o'.crc32($id_keranjang).crc32(date('ymdhis')),
                'id_produk' => $id_produk,
                'qty' => $qty,
                'total' => $harga_produk * $qty,
                'catatan' => $catatan,
                'id_order' => $id_order,
            ]);

            $min_stok = $produk->stok - $qty;
            $produk->update([
                'stok' => $min_stok
            ]);

        }

        /*foreach($keranjang as $keranjang)
        {
            OrderItem::create([
                'id_order_item' => $keranjang->id_keranjang,
                'id_produk' => $keranjang->id_produk,
                'qty' => $keranjang->qty,
                'total' => $keranjang->total,
                'catatan' => $keranjang->catatan,
                'id_order' => $id_order,
            ]);

            $min_stok = Produk::find($keranjang->id_produk);
            $stok_akhir = $min_stok->stok - $keranjang->qty;
            $min_stok->update([
                'stok' => $stok_akhir
            ]);
        }*/
        Order::create([
            'id_order' => $id_order,
            'id_user' => $user,
            'status' => 'dalam pemesanan',
        ]);

        OrderHistori::create([
            'id_order_histori' => 'oh'.date('ymdhis'),
            'status' => 'dalam pemesanan',
            'id_order' => $id_order,
        ]);

        return redirect('pengiriman/'.$id_order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
