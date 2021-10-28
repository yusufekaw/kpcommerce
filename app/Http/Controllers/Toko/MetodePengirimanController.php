<?php

namespace App\Http\Controllers\Toko;

use App\MetodePengiriman;
use App\OrderItem;
use App\Order;
use App\Keranjang;
use App\AlamatUser;
use App\Pengiriman;
use App\Halaman;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Mail;
use Auth;
use RajaOngkir;

class MetodePengirimanController extends Controller
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
    public function create($id_order, $id_alamat)
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Pengiriman ';

        $data['halaman'] = Halaman::all();

        $data['id_order'] = $id_order;
        $dataorder = Order::find($id_order);
        $berat = OrderItem::select(DB::raw('SUM(berat_total) as berat'))->get();
        $alamat = AlamatUser::find($id_alamat);
        $id_kota = $alamat->id_kota;
        $pengiriman = Pengiriman::where('id_alamat',$id_alamat)->get();
        
        $data['id_pengiriman']  = $pengiriman[0]['id_pengiriman'];
        $origin = 363;
        $destination = $id_kota;
        $data['weight'] = $berat[0]['berat'];
        $weight = $berat[0]['berat'];

        $data['jne'] = RajaOngkir::Cost([
            'origin'        => $origin, // id kota asal
            'destination'   => $destination, // id kota tujuan
            'weight'        => $weight, // berat satuan gram
            'courier'       => 'jne', // kode kurir pengantar ( jne / tiki / pos )
        ])->get();

        $data['pos'] = RajaOngkir::Cost([
            'origin'        => $origin, // id kota asal
            'destination'   => $destination, // id kota tujuan
            'weight'        => $weight, // berat satuan gram
            'courier'       => 'pos', // kode kurir pengantar ( jne / tiki / pos )
        ])->get();

        $data['tiki'] = RajaOngkir::Cost([
            'origin'        => $origin, // id kota asal
            'destination'   => $destination, // id kota tujuan
            'weight'        => $weight, // berat satuan gram
            'courier'       => 'tiki', // kode kurir pengantar ( jne / tiki / pos )
        ])->get();

        $data['keranjang'] = Keranjang::join('produks','produks.id_produk','Keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();

        return view('toko.transaksi.pengiriman.metode', compact('data'));

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
        //return $request->all();
        $id_metode_pengiriman = 'methodkrm'.crc32(date('ymdhis'));
        
        $pengiriman = MetodePengiriman::where('id_pengiriman', $request->id_pengiriman);

        if($pengiriman->count() > 0)
        {
            $pengiriman->update([
                'id_metode_pengiriman' => $id_metode_pengiriman,
                'kurir' => $request->kurir,
                'layanan' => $request->layanan,
                'berat' => $request->berat,
                'tarif' => $request->tarif,
                'id_pengiriman' => $request->id_pengiriman
            ]);
        }
        else
        {
            MetodePengiriman::create([
                'id_metode_pengiriman' => $id_metode_pengiriman,
                'kurir' => $request->kurir,
                'layanan' => $request->layanan,
                'berat' => $request->berat,
                'tarif' => $request->tarif,
                'id_pengiriman' => $request->id_pengiriman
            ]);
        }
       

        $id_order = $request->id_order;
        $pengiriman = Pengiriman::find($request->id_pengiriman);
        $id_alamat = $pengiriman->id_alamat;

        $mail = array(
                        'nama' => Auth::user()->nama_depan.' '.Auth::user()->nama_belakang,
                        'id_order' => $id_order,
                        'order_item' => OrderItem::join('produks','produks.id_produk','order_items.id_produk')
                                        ->where('id_order',$id_order)
                                        ->get(),
                        'pengiriman' => AlamatUser::find($id_alamat),
                        'metode_kirim' => MetodePengiriman::find($id_metode_pengiriman),
                        'bank' => Bank::all(),
                    );

        $address = Auth::user()->email;

        Mail::send('toko.mail.konfirmasi_order', $mail, function($message) use ($address){
            $message->to($address, 'member')->subject('Konfirmasi Order');
            $message->from('donotreply@cvbensonshop.masuk.id','donotreply@cvbensonshop.masuk.id');
        });
        
        return redirect('order/konfirmasi/'.$id_order);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MetodePengiriman  $metodePengiriman
     * @return \Illuminate\Http\Response
     */
    public function show(MetodePengiriman $metodePengiriman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MetodePengiriman  $metodePengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(MetodePengiriman $metodePengiriman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MetodePengiriman  $metodePengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetodePengiriman $metodePengiriman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MetodePengiriman  $metodePengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetodePengiriman $metodePengiriman)
    {
        //
    }
}
