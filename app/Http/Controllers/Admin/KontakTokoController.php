<?php

namespace App\Http\Controllers\Admin;

use App\KontakToko;
use App\Toko;
use App\Order;
use App\OrderItem;
use App\Produk;
use App\OrderHistori;
use App\Bank;
use App\User;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use Auth;

class KontakTokoController extends Controller
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
        $id = 'kontak'.crc32(date('ymdhis'));
        $this->validate($request, [
            'nama_kontak' => 'required',
            'jenis_kontak' => 'required',
            'kontak_info' => 'required'
        ]);

        list($jenis, $urutan, $ikon) = explode(' ', $request->jenis_kontak);
        
        
        if($jenis=='email')
        {
            $this->validate($request, [
                'kontak_info' => 'required|email'

            ]);
        }

        KontakToko::create([
            'id_kontak' => $id,
            'nama_kontak' => $request->nama_kontak,
            'jenis_kontak' => $jenis,
            'kontak_info' => $request->kontak_info,
            'ikon' => $ikon,
            'link' => $request->link,
            'urutan' => $urutan
        ]);

        return back()->with('success', 'berhasil menambah kontak baru');
        //return $request->all();

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\KontakToko  $kontakToko
     * @return \Illuminate\Http\Response
     */
    public function show(KontakToko $kontakToko)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\KontakToko  $kontakToko
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $data['kontak'] = KontakToko::find($id);

        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }

        return view('admin.toko.kontak.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\KontakToko  $kontakToko
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $kontak = KontakToko::find($id);
        $kontak->update([
            'nama_kontak' => $request->nama_kontak,
            'kontak_info' => $request->kontak_info,
            'link' => $request->link
        ]);

        return redirect('admin/toko/pengaturan')->with('success','berhasil memperbarui kontak info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\KontakToko  $kontakToko
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
        $kontak = KontakToko::find($id);
        $kontak->delete();
        return back()->with('success', 'berhasil menghapus kontak'); 
    }
}
