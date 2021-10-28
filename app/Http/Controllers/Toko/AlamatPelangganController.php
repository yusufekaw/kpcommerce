<?php

namespace App\Http\Controllers\Toko;

use App\AlamatPelanggan;
use App\Pelanggan;
use App\Pengiriman;
use App\AlamatUser;
use App\User;
use App\Keranjang;
use App\Provinsi;
use App\Kota;
use App\Halaman;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Auth;

class AlamatPelangganController extends Controller
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
    public function create()
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko;
        //menu utama
        $data['halaman'] = Halaman::all();
        //ambil semua data provinsi
        $data['provinsi'] = Provinsi::all()->pluck("nama_provinsi","id_provinsi");
        //menampilkan keranjang belanja
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        return view('toko.pelanggan.alamat.tambah', compact('data'));
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
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko;
        $id_alamat = 'almt'.crc32(date('ymdhis'));
        $kotas = Kota::find($request->kota);
        $provinsis = Provinsi::find($request->provinsi);
        $kota = $kotas->nama_kota;
        $provinsi = $provinsis->nama_provinsi;
        $this->validate($request, [
            'atas_nama' => 'required',
            'jenis' => 'required',
            'telp' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kodepos' => 'required',
        ]);

        AlamatUser::create([
            'id_alamat' => $id_alamat,
            'atas_nama' => $request->atas_nama,
            'jenis' => $request->jenis,
            'telp' => $request->telp,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'jalan' => $request->jalan,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'id_kota' => $request->kota,
            'id_provinsi' => $request->provinsi,
            'kota' => $kota,
            'provinsi' => $provinsi,
            'kodepos' => $request->kodepos,
            'id_user' => Auth::user()->id_user,
        ]);

        //$id_pengiriman = $request->pengiriman;
        $ref = $request->ref;
        
        if($ref=='detail')
        {
            return redirect('/pelanggan')->with('alert','berhasil manambah alamat baru');
        }
        else
        {

            $id_order = $request->id_order;
            $id_pengiriman = 'kirim'.crc32(date('ymdhis'));
            Pengiriman::create([
                'id_pengiriman' => $id_pengiriman,
                'id_order' => $id_order,
                'id_alamat' => $id_alamat
            ]);
            return redirect('pengiriman/metode/order/'.$id_order.'/alamat/'.$id_alamat); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AlamatPelanggan  $alamatPelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(AlamatPelanggan $alamatPelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AlamatPelanggan  $alamatPelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko;
        //ambil semua data provinsi
        $data['provinsi'] = Provinsi::all()->pluck("nama_provinsi","id_provinsi");
        $data['halaman'] = Halaman::all();
        $data['alamat'] = AlamatUser::find($id);
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        return view('toko.pelanggan.alamat.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AlamatPelanggan  $alamatPelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $alamat = AlamatUser::find($id);
        $kotas = Kota::find($request->kota);
        $provinsis = Provinsi::find($request->provinsi);
        $kota = $kotas->nama_kota;
        $provinsi = $provinsis->nama_provinsi;

        $this->validate($request, [
            'atas_nama' => 'required',
            'jenis' => 'required',
            'telp' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'kodepos' => 'required',
        ]);

        $alamat->update([
            'atas_nama' => $request->atas_nama,
            'jenis' => $request->jenis,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'jalan' => $request->jalan,
            'telp' => $request->telp,
            'kelurahan' => $request->kelurahan,
            'kecamatan' => $request->kecamatan,
            'id_kota' => $request->kota,
            'id_provinsi' => $request->provinsi,
            'kota' => $kota,
            'provinsi' => $provinsi,
            'kodepos' => $request->kodepos,
        ]);
        return redirect('pelanggan')->with('alert','Berhasil mengupdate alamat!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AlamatPelanggan  $alamatPelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $alamat = Alamatuser::find($id);
        $alamat->delete();
        return redirect('pelanggan')->with('alert','Berhasil menghapus alamat!');
    }

    public function getKota($id) 
     {
        $kota = Kota::select(DB::raw("CONCAT(tipe,' ',nama_kota) as nama"),"id_kota")->where("id_provinsi",$id)->pluck("nama","id_kota");

        return json_encode($kota);

    }
}
