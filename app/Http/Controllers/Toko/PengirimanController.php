<?php

namespace App\Http\Controllers\Toko;

use App\Pengiriman;
use App\AlamatUser;
use App\Keranjang;
use App\Provinsi;
use App\Kota;
use App\Halaman;
use App\Toko;
use App\Bank;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class PengirimanController extends Controller
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
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Pengiriman ';
        $data['halaman'] = Halaman::all();
        $data['id_order'] = $id;
        $data['provinsi'] = Provinsi::all()->pluck("nama_provinsi","id_provinsi");
        $data['id_user'] = Auth::user()->id_user;
        $data['alamat'] = AlamatUser::join('provinsis','alamat_users.id_provinsi','=','provinsis.id_provinsi')
                            ->join('kotas','alamat_users.id_kota','=','kotas.id_kota')
                            ->where('id_user',Auth::user()->id_user)
                            ->get();
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        return view('toko.transaksi.pengiriman.index',compact('data'));
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
        $pengiriman = Pengiriman::where('id_order',$request->id_order);
        if($pengiriman->count()>0)
        {
            $pengiriman->update([
                'id_alamat' => $request->id_alamat,
            ]);
        }
        else
        {            
        Pengiriman::create([
            'id_pengiriman' => 'krm'.crc32(date('ymdhis')),
            'id_order' => $request->id_order,
            'id_alamat' => $request->id_alamat,
        ]);
        }

        $id_order = $request->id_order;
        $id_alamat = $request->id_alamat;

        return redirect('pengiriman/metode/order/'.$id_order.'/alamat/'.$id_alamat);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengiriman $pengiriman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengiriman $pengiriman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengiriman $pengiriman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengiriman  $pengiriman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengiriman $pengiriman)
    {
        //
    }
}
