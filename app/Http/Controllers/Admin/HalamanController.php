<?php

namespace App\Http\Controllers\Admin;

use App\Halaman;
use App\Order;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class HalamanController extends Controller
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
        //order masuk
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
        $data['halaman'] = Halaman::all();
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        //end tampil di navber
        return view('admin.halaman.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        //end tampil di navber
        return view('admin.halaman.create',compact('data'));
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
        $id_halaman = 'page'.crc32(date('ymdhis'));
        $this->validate($request, [
            'judul' => 'required',
            'konten' => 'required',
        ]);
        Halaman::create([
            'id_halaman' => $id_halaman,
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);
        return redirect('admin/halaman')->with('success','Berhasil menambah halaman baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $data['halaman'] = Halaman::find($id);
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.halaman.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $data['halaman'] = Halaman::find($id);
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.halaman.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $halaman = Halaman::find($id);
        $this->validate($request, [
            'judul' => 'required',
            'konten' => 'required',
        ]);
        $halaman->update([
            'judul' => $request->judul,
            'konten' => $request->konten,
        ]);
        return redirect('admin/halaman')->with('success','Berhasil mengubah halaman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Halaman  $halaman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        $halaman = Halaman::find($id);
        $halaman->delete();
        return redirect('admin/halaman')->with('success', 'berhasil menghapus halaman!');
    }
}
