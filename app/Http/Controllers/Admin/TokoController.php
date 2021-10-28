<?php

namespace App\Http\Controllers\Admin;

use App\Toko;
use App\LokasiToko;
use App\KontakToko;
use App\Order;
use App\OrderItem;
use App\Produk;
use App\OrderHistori;
use App\Bank;
use App\User;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


use Intervention\Image\ImageManagerStatic as Image;
use File;
use DB;

class TokoController extends Controller
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
        //order
        $order = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order->get();
        $data['order_count'] = $order->count();
        $data['order_sukses'] = Order::where('kode_status','>=','7')->count();
        //user
        $pelanggan = User::where('role','pelanggan');
        $data['pelanggan'] = $pelanggan->count();
        //Menghitung Pendapatan
        $pendapatan = OrderItem::select(DB::raw('nama_produk as produk, sum(qty) as terjual, sum(total_harga) as total, date(order_items.created_at) as date'))
                        ->join('produks','produks.id_produk','order_items.id_produk')
                        ->join('orders','orders.id_order','order_items.id_order')
                        ->groupBy('date')
                        ->get();
        $data['pendapatan'] = json_encode($pendapatan);
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        $data['toko'] = Toko::find('1');
        $data['lokasi'] = LokasiToko::find('1');
        $data['kontak'] = KontakToko::all();
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.toko.index', compact('data'));
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
     * @param  \App\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function show(Toko $toko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function edit(Toko $toko)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $toko = Toko::find($id);

        $this->validate($request, [
            'nama_toko' => 'required',
            'tagline' => 'required',
            'deskripsi' => 'required',
        ]);     
        
        $toko->update([
            'nama_toko' => $request->nama_toko,
            'tagline' => $request->tagline,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'berhasil mengupdate data toko');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Toko  $toko
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toko $toko)
    {
        //
    }

    public function logo_update(Request $request, $id)
    {
        //
        $toko = Toko::find($id);

        File::makeDirectory('img/toko/'.$id.'/', 0777, true, true);

        $img = $request->file('logo');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/toko/'.$id.'/';
        $img_name = 'logotoko.'.$extension;

        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));

        $toko->update([
            'logo' => $destinationpath.''.$img_name,
        ]);
        return back()->with('success', 'Berhasil mengubah logo toko');

        //return $request->file('logo')->getClientOriginalName();
    }
}
