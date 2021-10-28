<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use App\OrderItem;
use App\AlamatUser;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class PelangganController extends Controller
{
    
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
        $order = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order->get();
        $data['order_count'] = $order->count();
        $data['order_sukses'] = Order::where('kode_status','>=','7')->count();
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        $data['pelanggan'] = User::where('role', 'pelanggan')->get();
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.pelanggan.index', compact('data'));
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        //
        $order = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order->get();
        $data['order_count'] = $order->count();
        $data['order_sukses'] = Order::where('kode_status','>=','7')->count();
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        $data['pelanggan'] = User::find($id);
        $data['alamat'] = AlamatUser::where('id_user',$id)->get();
        $data['order_by_user'] = Order::where('id_user',$id)->get();
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.pelanggan.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
