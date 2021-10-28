<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Order;
use App\OrderItem;
use App\KomentarProduk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\ImageManagerStatic as Image;
use File;
use DB;
use Auth;

class UserController extends Controller
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
        $data['useradmin'] = User::where('role','!=','pelanggan')->where('id_user','!=',Auth::user()->id_user)->get();
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        if(Auth::user()->role=='admin')
        {
            return redirect('admin');
        }
        return view('admin.user.index', compact('data'));
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
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        if(Auth::user()->role=='admin')
        {
            return redirect('admin');
        }
        return view('admin.user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id_user = 'adm'.crc32(date('ymdhis'));

         File::makeDirectory('img/user/'.$id_user.'/', 0777, true, true);

        $this->validate($request, [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'role' => 'required',
            'avatar' => 'required|file|image|max:3000',
            'password' => 'required|min:8',
            'konfirmasi_password' => 'required|min:8|required_with:password|same:password',
        ]);

        $img = $request->file('avatar');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/user/'.$id_user.'/';
        $img_name = $id_user.'.'.$extension;

        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));

        User::create([
            'id_user' => $id_user,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'gender' => $request->gender,
            'email' => $request->email,
            'role' => $request->role,
            'avatar' => $destinationpath.''.$img_name,
            'password' => Hash::make($request->password),            
        ]);
        return redirect('admin/useradmin')->with('success','Berhasil menambah admin baru!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
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
        $data['useradmin'] = User::find($id);
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        if(Auth::user()->role=='admin')
        {
            return redirect('admin');
        }
        return view('admin.user.detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
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
        $data['useradmin'] = User::find($id);
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        if(Auth::user()->role=='admin')
        {
            return redirect('admin');
        }
        return view('admin.user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
       $this->validate($request, [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);

        $user->update([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'gender' => $request->gender,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect('admin/useradmin')->with('success','Berhasil mengubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        if(Auth::user()->role=='admin')
        {
            return redirect('admin');
        }
        $user = User::find($id);
        $user->delete();
        return redirect('admin/useradmin')->with('success', 'Berhasil menghapus admin!');
    }

    public function avatar_update(Request $request, $id)
    {
        $user = User::find($id);

        File::makeDirectory('img/user/'.$id.'/', 0777, true, true);

        $img = $request->file('avatar');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/user/'.$id.'/';
        $img_name = $id.'.'.$extension;

        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));

        $user->update([
            'avatar' => $destinationpath.''.$img_name,
        ]);
        return back()->with('success', 'Berhasil mengubah foto profil');
    }

    public function password($id)
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
        $data['useradmin'] = User::find($id);
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        if(Auth::user()->role=='admin')
        {
            return redirect('admin');
        }
        return view('admin.user.password', compact('data'));
    }

    public function password_update(Request $request, $id)
    {
        //
        $user = User::find($id);

        $this->validate($request, [
            'password' => 'required|min:8',
            'konfirmasi_password' => 'required|min:8|required_with:password|same:password',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);


        return redirect('admin/useradmin/detail/'.$id)->with('success', 'Berhasil mengganti password');
    }

}
