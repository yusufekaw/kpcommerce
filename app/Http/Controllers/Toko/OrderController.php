<?php

namespace App\Http\Controllers\Toko;

use App\Order;
use App\Keranjang;
use App\OrderItem;
use App\OrderHistori;
use App\Produk;
use App\Halaman;
use App\MetodePengiriman;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class OrderController extends Controller
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
    public function create($id)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Order ';
        $data['halaman'] = Halaman::all();
        //keranjang belanjan
        $data['keranjang'] = Keranjang::join('produks','produks.id_produk','Keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        //daftar pesanan
        $data['order'] = OrderItem::join('produks','produks.id_produk','order_items.id_produk')->where('order_items.id_order',$id)->get();
        //metode pengiriman
        $data['metode_pengiriman'] = MetodePengiriman::join('pengirimans', 'pengirimans.id_pengiriman', 'metode_pengirimans.id_pengiriman')->where('pengirimans.id_order',$id)->get();
        $data['id'] = $id;
        return view('toko.transaksi.order.konfirmasi', compact('data'));
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

        foreach ($request->id_user as $key => $value)
        {
            $id_keranjang = $keranjang['id_keranjang'][$key];
            $id_produk = $keranjang['id_produk'][$key];
            $qty = $keranjang['qty'][$key];
            $catatan = $keranjang['catatan'][$key];

            $produk = Produk::find($id_produk);
            $harga = $produk->harga;
            $berat = $produk->berat;

            OrderItem::create([
                'id_order_item' => 'o'.crc32($id_keranjang).crc32(date('ymdhis')),
                'id_produk' => $id_produk,
                'qty' => $qty,
                'total_harga' => $harga * $qty,
                'berat_total' => $berat * $qty,
                'catatan' => $catatan,
                'id_order' => $id_order,
            ]);

            $min_stok = $produk->stok - $qty;
            $produk->update([
                'stok' => $min_stok
            ]);

        }

        
        Order::create([
            'id_order' => $id_order,
            'id_user' => $user,
            'kode_status' => 1,
            'status' => 'dipesan',
        ]);

        OrderHistori::create([
            'id_order_histori' => 'oh'.date('ymdhis'),
            'kode_status' => 1,
            'status' => 'dipesan',
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
    public function show($id)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Order ';

        $order = Order::find($id);
        $data['status'] = $order->status;
        $data['kode_status'] = $order->kode_status;
        $data['halaman'] = Halaman::all();
        $data['id'] = $id;
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        //cari order item berdasarkan id
        $data['order'] = OrderItem::join('produks','order_items.id_produk','produks.id_produk')->where('id_order',$id)->get();
        ///riwayat order
        $data['order_histori'] = OrderHistori::where('id_order', $id)->orderBy('created_at','desc')->orderBy('kode_status','desc')->get();
        //metode pengiriman
        $data['metode_pengiriman'] = MetodePengiriman::join('pengirimans', 'pengirimans.id_pengiriman', 'metode_pengirimans.id_pengiriman')->where('pengirimans.id_order',$id)->get();
        $data['pengiriman'] = MetodePengiriman::join('pengirimans', 'pengirimans.id_pengiriman', 'metode_pengirimans.id_pengiriman')->where('pengirimans.id_order',$id)->count();
        return  view('toko.transaksi.order.detail', compact('data'));

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
    public function update(Request $request, $id)
    {
        //
        $order = Order::find($id);
        $order->update([
            'kode_status' => $request->kode_status,
            'status' => $request->status
        ]);

        OrderHistori::create([
            'id_order_histori' => 'oh'.date('ymdhis'),
            'kode_status' => $request->kode_status,
            'status' => $request->status,
            'id_order' => $id,
        ]);

        //echo "Suwun<br>Ndang Bayar!";

        return redirect('order/pembayaran/'.$request->id_order);
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

    public function pembayaran($id){
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Pembayaran ';
        $data['id'] = $id;
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        $data['order'] = OrderItem::join('produks','produks.id_produk','order_items.id_produk')->where('order_items.id_order',$id)->get();
        $data['metode_pengiriman'] = MetodePengiriman::join('pengirimans', 'pengirimans.id_pengiriman', 'metode_pengirimans.id_pengiriman')->where('pengirimans.id_order',$id)->get();
        return view('toko.transaksi.order.pembayaran', compact('data'));
    }
}
