<?php

namespace App\Http\Controllers\Admin;

use App\Kategori;
use App\Order;
use App\Produk;
use App\KomentarProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;

use DB;

class KategoriController extends Controller
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
        $order = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order->get();
        $data['order_count'] = $order->count();
        $data['title'] = "Kategori Produk";
        $data['kategori'] = Kategori::all();
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.kategori.index', compact('data'));
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
            'nama_kategori' => 'required',
        ]);

        $id = crc32(date('ymdhis'));

        Kategori::create([
            'id_kategori' => 'k'.$id,
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin/kategori')->with('success', 'Berhasil menambah kategori baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order->get();
        $data['order_count'] = $order->count();
        $kategori = $data['kategori'] = Kategori::find($id);
        $data['title'] = "Semua Produk di Kategori ".$kategori->nama_kategori;
        $data['produk'] = Produk::join('kategoris', 'kategoris.id_kategori','produks.id_kategori')->where('produks.id_kategori',$id)->paginate(12);

        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.produk.index', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $order = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order->get();
        $data['order_count'] = $order->count();
        $data['title'] = "Kategori Produk";
        $data['kategori'] = Kategori::all();
        $data['kategori_edited'] = Kategori::find($id);
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }

        return view('admin/kategori/edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategori::find($id);
        $kategori->update($request->all());
        return redirect()->route('admin/kategori')->with('success', 'Berhasil mengubah kategori!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect()->route('admin/kategori')->with('success', 'Berhasil menghapus kategori!');
    }
}
