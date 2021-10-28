<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Pembayaran;
use App\OrderItem;
use App\OrderHistori;
use App\Pengiriman;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
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
        $title = "Order";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order_all'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['order'] = Order::select(DB::raw('id_order, concat(nama_depan," ",nama_belakang) as nama, status, orders.created_at as tanggal'))
                        ->join('users', 'orders.id_user', 'users.id_user')->get();
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.order.index', compact('data'));
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
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $title = "Order Detail";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['order_detail'] = Order::join('users', 'orders.id_user', 'users.id_user')->find($id);
        $data['bayar'] = Pembayaran::where('id_order',$id)->latest('created_at')->first();
        /*if($data['bayar']->count==0)
        {
            $data['bayar'] = 
        }*/
        $data['pengiriman'] = Pengiriman::join('alamat_users','alamat_users.id_alamat','pengirimans.id_alamat')
                        ->join('metode_pengirimans','metode_pengirimans.id_pengiriman','pengirimans.id_pengiriman')
                        ->where('id_order',$id)->first();
        $data['order_histori'] = OrderHistori::where('id_order',$id)->orderBy('created_at', 'ASC')->get();
        $order_item = OrderItem::join('produks', 'produks.id_produk', 'order_items.id_produk')->where('id_order',$id);
        $data['order_item_sum'] = $order_item->sum('total_harga');
        $data['order_item_all'] = $order_item->get();
        
//        return $pengiriman->tarif;
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.order.detail', compact('data'));
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

    public function filter_tanggal(Request $request)
    {
         $title = "Order";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order_all'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['order'] = Order::select(DB::raw('id_order, concat(nama_depan," ",nama_belakang) as nama, status, orders.created_at as tanggal'))
                        ->join('users', 'orders.id_user', 'users.id_user')
                        ->whereBetween('orders.created_at',[$request->daritanggal.' 00:00:01', $request->sampaitanggal.' 23:59:59'])
                        ->get();
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.order.index', compact('data'));
    }
}
