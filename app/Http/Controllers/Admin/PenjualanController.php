<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Produk;
use App\Pembayaran;
use App\OrderItem;
use App\OrderHistori;
use App\Pengiriman;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class PenjualanController extends Controller
{
    //
    protected $redirectTo = '/admin';
    
    public function __construct()
    {
        $this->middleware('auth');        
    }
    
    public function index()
    {
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
    	$title = "Penjualan";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders..kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['order_all'] = Order::join('users', 'orders.id_user', 'users.id_user')->get();
        $data['produk'] = OrderItem::select(DB::raw('produks.id_produk as id_produk, nama_produk as produk, sum(qty) as terjual, sum(total_harga) as total, date(orders.created_at) as tanggal'))
                        ->join('produks','produks.id_produk','order_items.id_produk')
                        ->join('orders','orders.id_order','order_items.id_order')
                        ->groupBy('produks.id_produk')
                        ->groupBy(DB::raw('Date(orders.created_at)'))
                        ->get();
          //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
    	return view('admin.penjualan.index', compact('data'));
    }

    public function order()
    {
    	$order;
    }

    public function filter_tanggal(Request $request)
    {
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        $title = "Penjualan";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders..kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['order_all'] = Order::join('users', 'orders.id_user', 'users.id_user')->get();
        $produk = OrderItem::select(DB::raw('produks.id_produk as id_produk, nama_produk as produk, sum(qty) as terjual, sum(total_harga) as total, date(orders.created_at) as tanggal'))
                        ->join('produks','produks.id_produk','order_items.id_produk')
                        ->join('orders','orders.id_order','order_items.id_order')
                        ->groupBy('produks.id_produk')
                        ->groupBy(DB::raw('Date(orders.created_at)'))
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
        return view('admin.penjualan.index', compact('data'));
    }

    public function show($id)
    {
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        $title = "Penjualan";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['order_all'] = Order::join('users', 'orders.id_user', 'users.id_user')->get();

        $produk = Produk::find($id);
        $data['nama_produk'] = $produk->nama_produk;
        $data['produk'] =  OrderItem::select(DB::raw('produks.id_produk as id_produk, nama_produk as produk, sum(qty) as terjual, sum(total_harga) as total, date(orders.created_at) as tanggal'))
                        ->join('produks','produks.id_produk','order_items.id_produk')
                        ->join('orders','orders.id_order','order_items.id_order')
                        ->groupBy('produks.id_produk')
                        ->groupBy(DB::raw('Date(orders.created_at)'))
                        ->where('produks.id_produk',$id)
                        ->get();
        //$data['pendapatan'] = $produk->sum('total_harga');
          //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        //return $data['produk'];
        $data['produk'] = json_encode($data['produk']);
        return view('admin.penjualan.detail', compact('data'));
    }
}
