<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\Order;
use App\User;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Intervention\Image\ImageManagerStatic as Image;
use File;
use DB;


class BankController extends Controller
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
        $data['order_sukses'] = Order::where('kode_status','>=','7')->count();
        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->where('kode_status','1')
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->count();
        $data['komentar_all'] = $komentar->get();
        $data['useradmin'] = User::where('role','!=','pelanggan')->get();
        $data['bank'] = Bank::all();
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.bank.index', compact('data'));
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
        $id_bank = 'bank'.crc32(date('ymdhis'));
        File::makeDirectory('img/bank/', 0777, true, true);
             
        $this->validate($request, [
            'kode_bank' => 'required',
            'nama_bank' => 'required|min:3',
            'rekening' => 'required|min:1',
            'atas_nama' => 'required',
            'logo' => 'required|file|image|max:3000',
        ]);

        $img = $request->file('logo');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/bank/';
        $img_name = $request->nama_bank.'.'.$extension;

        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(500, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));

        Bank::create([
            'id_bank' => $id_bank,
            'kode_bank' => $request->kode_bank,
            'nama_bank' => $request->nama_bank,
            'rekening' => $request->rekening,
            'atas_nama' => $request->atas_nama,
            'logo' => $destinationpath.''.$img_name
        ]);

        return redirect('admin/bank/')->with('success', 'berhasil menambahkan data bank baru');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
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
        $data['useradmin'] = User::where('role','!=','pelanggan')->get();
        $data['bank'] = Bank::find($id);
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.bank.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
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
        $data['useradmin'] = User::where('role','!=','pelanggan')->get();
        $data['bank'] = Bank::find($id);
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin.bank.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        
         $this->validate($request, [
            'kode_bank' => 'required',
            'nama_bank' => 'required|min:3',
            'rekening' => 'required|min:1',
            'atas_nama' => 'required',
        ]);     
        
        $bank = Bank::find($id);
        $bank->update([
            'kode_bank' => $request->kode_bank,
            'nama_bank' => $request->nama_bank,
            'rekening' => $request->rekening_bank,
            'atas_nama' => $request->atas_nama,
        ]);

        return redirect('admin/bank/')->with('success', 'berhasil mengupdate data bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
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
        $bank = Bank::find($id);
        $bank->delete();
        return redirect('admin/bank/')->with('success', 'berhasil menghapus data bank');
    }

    public function logo_update(Request $request, $id)
    {
        $bank = Bank::find($id);

        File::makeDirectory('img/bank/'.$id.'/', 0777, true, true);

        $img = $request->file('logo');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/bank/'.$id.'/';
        $img_name = $id.'.'.$extension;

        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));

        $bank->update([
            'logo' => $destinationpath.''.$img_name,
        ]);
        return back()->with('success', 'Berhasil mengubah logo bank');
    }
}
