<?php

namespace App\Http\Controllers\Admin;

use App\Produk;
use App\GambarProduk;
use App\Kategori;
use App\Order;
use App\KomentarProduk;
use Illuminate\Http\Request;

use Intervention\Image\ImageManagerStatic as Image;
use File;
use DB;
use Auth;

class ProdukController extends Controller
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
        $data['produk'] = Produk::join('kategoris', 'produks.id_kategori', '=', 'kategoris.id_kategori')->paginate(16);
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['title'] = 'Semua Produk';
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Edit Produk";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['title'] = 'Semua Produk';
        $data['kategori'] = Kategori::all();
        $kategori_all = Kategori::all();
        $title = 'Tambah Produk';
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
        return view('admin.produk.create', compact('data'));
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
        $get_id = date('ymdhis');
        $next_id = 'p'.crc32($get_id);

        File::makeDirectory('img/produk/'.$next_id.'/', 0777, true, true);
             
        $this->validate($request, [
            'nama_produk' => 'required',
            'harga' => 'required|min:3',
            'stok' => 'required|min:1',
            'berat' => 'required',
            'gambar' => 'required|file|image|max:3000',
            'deskripsi' => 'required',
            'id_kategori' => 'required',
        ]);

        $img = $request->file('gambar');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/produk/'.$next_id.'/';
        $img_name = $next_id.'.'.$extension;

        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));

        //$path = $img->move($destinationpath, $img_name);
        
        Produk::create([
            'id_produk' => $next_id,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'berat' => $request->berat,
            'gambar' => $destinationpath.''.$img_name,
            'deskripsi' => $request->deskripsi,
            'id_kategori' => $request->id_kategori,
        ]);
        $i=0;
        if($request->hasfile('path'))
         {

            foreach($request->file('path') as $image)
            {
                
                //$img_produk_name = $image->getClientOriginalName();
                $ext_img = $image->getClientOriginalExtension();
                $img_produk_name = $next_id.'_g'.crc32(date('ymdhis')).''.$i.'.'.$ext_img;
                
                $image_resize = Image::make($image->getRealPath());              
                $image_resize->resize(300, 300);
                $image_resize->save(public_path($destinationpath.''.$img_produk_name));
                
                //$path_img_produk = $image->move($destinationpath, $img_produk_name);  
                //$data[] = $img_produk_name;
                GambarProduk::create([
                    'id_gambar' => $next_id.'_g'.crc32(date('ymdhis')).$i,  
                    'path' => $destinationpath.''.$img_produk_name,
                    'id_produk'  => $next_id,  
                ]);
                $i++;
            }
         }

        return redirect()->route('admin/produk')->with('success', 'Berhasil menambah produk baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $title = "Detail Produk";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['title'] = 'Semua Produk';
        $data['produk'] = Produk::join('kategoris', 'produks.id_kategori', '=', 'kategoris.id_kategori')->find($id);
        $data['gambar_produk'] = GambarProduk::where('id_produk',$id)->get();

        $komentar = KomentarProduk::where('id_produk',$id);
        /*foreach($komentar as $komentar)
        {
            $komentar_update = KomentarProduk::find($komentar->id_komentar_produk)
            $komentar_::update([
                'kode_status' => '2',
                'status' => 'dibaca'
            ]);    
        }*/

        $komentar->update([
                'kode_status' => '2',
                'status' => 'dibaca'
            ]);
        

        //komentar masuk
        $komentar = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->orderBy('komentar_produks.created_at', 'DESC');
        $data['komentar_count'] = $komentar->where('kode_status','1')->count();
        $data['komentar_all'] = $komentar->get();
        $data['komentar_all_detail'] = KomentarProduk::join('users','users.id_user','komentar_produks.id_user')
                            ->join('produks','produks.id_produk','komentar_produks.id_produk')
                            ->select(DB::raw('komentar_produks.id_komentar_produk as id_koment, concat(users.nama_depan," ",users.nama_belakang) as nama, users.role as role, komentar_produks.created_at as tanggal, komentar_produks.komentar as komentar, produks.nama_produk as produk, produks.gambar as gambar, users.avatar as avatar, produks.id_produk as id_produk'))
                            ->orderBy('komentar_produks.created_at', 'DESC')
                            ->where('komentar_produks.id_produk',$id)
                            ->paginate(24);
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        return view('admin/produk/detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $title = "Edit Produk";
        $order_all = Order::join('users', 'orders.id_user', 'users.id_user')->where('orders.kode_status','3');
        $data['order'] = $order_all->get();
        $data['order_count'] = $order_all->count();
        $data['title'] = 'Semua Produk';
        $data['kategori'] = Kategori::all();
        $data['produk'] = Produk::find($id);
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
        return view('admin.produk.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $this->validate($request, [
            'nama_produk' => 'required',
            'harga' => 'required|min:3',
            'stok' => 'required|min:1',
            'deskripsi' => 'required',
            'id_kategori' => 'required',
        ]);

        /*$img = $request->file('gambar'); 
        $destinationpath = 'img/produk/'.$id.'/';
        $img_name = $img->getClientOriginalName(); 
        $path = $img->move($destinationpath, $img_name);
*/

        $produk_to_update = Produk::find($id);
        $produk_to_update->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'id_kategori' => $request->id_kategori,
        ]);

         return redirect()->route('admin/produk')->with('success', 'Berhasil mengubah data produk!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        $produk = Produk::find($id);
        $produk->delete();
        GambarProduk::where('id_produk',$id)->delete();
        return redirect()->route('admin/produk')->with('success', 'Berhasil menghapus produk!');
    }

    public function gambar_update(Request $request,$id)
    {
        $produk = Produk::find($id);

        $this->validate($request, [
            'gambar' => 'required|file|image|max:3000',
        ]);

        $img = $request->file('gambar');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/produk/'.$id.'/';
        $img_name = $id.'.'.$extension;

        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));

        $produk->update([
            'gambar' => $destinationpath.''.$img_name
        ]);

        return back()->with('success', 'berhasil mengubah gambar ikon produk');

    }
}
