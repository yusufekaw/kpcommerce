<?php

namespace App\Http\Controllers\Toko;

use App\Pembayaran;
use App\Keranjang;
use App\Order;
use App\OrderItem;
use App\OrderHistori;
use App\Produk;
use App\Bank;
use App\Toko;
use App\KontakToko;
use App\Halaman;
use App\MetodePengiriman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Intervention\Image\ImageManagerStatic as Image;
use File;

use Auth;
use Mail;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Pembayaran ';

        $data['id'] = $id;
        $data['halaman'] = Halaman::all();
        $data['bank'] = Bank::all();
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        $data['order'] = OrderItem::join('produks','produks.id_produk','order_items.id_produk')->where('order_items.id_order',$id)->get();
        $data['metode_pengiriman'] = MetodePengiriman::join('pengirimans', 'pengirimans.id_pengiriman', 'metode_pengirimans.id_pengiriman')->where('pengirimans.id_order',$id)->get();
        return view('toko.transaksi.pembayaran.index', compact('data'));
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
        $data['title'] = $toko->nama_toko.' | Pembayaran ';
        //apakah order valid?
        $order_status = Order::find($id);
        //id order
        $data['id_order'] = $id;
        //menu utama
        $data['halaman'] = Halaman::all();
        //daftar bank toko
        $data['bank'] = Bank::all();
        //keranjang belanja
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        //menghitung total pembayaran
        $transaksi = OrderItem::where('id_order',$id);
        $total_bayar_produk = $transaksi->sum('total_harga');
        $kurir =  MetodePengiriman::join('pengirimans', 'pengirimans.id_pengiriman', 'metode_pengirimans.id_pengiriman')->where('pengirimans.id_order',$id)->get();
        $total_bayar_kurir = $kurir[0]['tarif'];
        $data['nominal'] = $total_bayar_kurir + $total_bayar_produk;

        if($order_status->status == 'dibayar' || $order_status->count()==0)
        {
            return view('toko.404',compact('data'));
        }
        else
        {            
        return view('toko.transaksi.pembayaran.konfirmasi',compact('data'));
        }
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
        //generate id pembayaran
        $id_pembayaran = 'bayar'.crc32(date('ymdhis'));
        //membuat direktori
        File::makeDirectory('img/pembayaran/'.$id_pembayaran.'/', 0777, true, true);
        //validasi
        $this->validate($request, [
            'bank_tujuan' => 'required',
            'nama_bank' => 'required',
            'rekening' => 'required',
            'atas_nama' => 'required',
            'nominal' => 'required',
            'bukti' => 'required|file|image|max:3000',
            'id_order' => 'required',
        ]);
        //file upload
        $img = $request->file('bukti');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/pembayaran/'.$id_pembayaran.'/';
        $img_name = $id_pembayaran.'.'.$extension;
        //resize gambar
        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 600);
        $image_resize->save($destinationpath.''.$img_name);

        //$path = $img->move($destinationpath, $img_name);
        //simpan bukti transfer
        Pembayaran::create([
            'id_pembayaran' => $id_pembayaran,
            'bank_tujuan' => $request->bank_tujuan,
            'nama_bank' => $request->nama_bank,
            'rekening' => $request->rekening,
            'atas_nama' => $request->atas_nama,
            'nominal' => $request->nominal,
            'bukti' => $destinationpath.''.$img_name,
            'id_order' => $request->id_order,
        ]);

        OrderHistori::create([
            'id_order_histori' => 'oh'.date('ymdhis'),
            'id_order' => $request->id_order,
            'kode_status' => '3',
            'status' => 'dibayar'
        ]);

        $order = Order::find($request->id_order);
        $order->update([
            'kode_status' => '3',
            'status' => 'dibayar'
        ]);

        $address = Auth::user()->email;

        $mail = array( 'name' => Auth::user()->nama_depan.' '.Auth::user()->nama_belakang );

        Mail::send('toko.mail.konfirmasi_pembayaran', $mail, function($message) use ($address){
            $message->to($address, 'member')->subject('Konfirmasi Order');
            $message->from('donotreply@cvbensonshop.masuk.id','donotreply@cvbensonshop.masuk.id');
        });
        
        return redirect('pembayaran/upload/sukses/'.$id_pembayaran);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
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
        $data['title'] = $toko->nama_toko.' | Pembayaran ';
        //menu utaman
        $data['halaman'] = Halaman::all();
        //keranjang belanja
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();

        return view('toko.transaksi.pembayaran.sukses', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }
}
