<?php

namespace App\Http\Controllers\Toko;

use App\Pelanggan;
use App\AlamatUser;
use App\User;
use App\Keranjang;
use App\Kategori;
use App\Halaman;
use App\Order;
use App\Item;
use App\Bank;
use App\Toko;
use App\KontakToko;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Intervention\Image\ImageManagerStatic as Image;
use File;

use Auth;
use Mail;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Pelanggan';//id user
        $id_user = Auth::user()->id_user;
        $data['keranjang'] = null;
        //jika user login menampilkan keranjang belanja
        if(Auth::user())
        {
            $data['keranjang'] = Keranjang::join('produks','produks.id_produk','keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
        }
        //keranjang belanja
        $data['order'] = Order::where('id_user',$id_user)->orderby('.created_at', 'desc')->get();
        $data['alamat'] = AlamatUser::join('provinsis','alamat_users.id_provinsi','provinsis.id_provinsi')
                            ->join('kotas','alamat_users.id_kota','kotas.id_kota')
                            ->where('id_user',$id_user)->get();
        //kategori produk
        $data['kategori'] = Kategori::all();
        //menu utaman
        $data['halaman'] = Halaman::all();
        return view('toko.pelanggan.index', compact('data'));

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
        $toko = Toko::find('1');
        $this->validate($request, [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'min:8|required_with:password|same:password',
        ]);

        User::create([
            'id_user' => 'cust'.date('ymdhis'),
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'role' => 'pelanggan',
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        $address = $request->email;

        $mail = array(
                        'name' => $request->nama_depan.' '.$request->nama_belakang,
                        'nama_toko' => $toko->nama_toko,
                    );
        Mail::send('toko.mail.register', $mail, function($message) use ($address){
            $message->to($address, 'member')->subject('Registrasi Berhasil');
            $message->from('donotreply@cvbensonshop.masuk.id','donotreply@cvbensonshop.masuk.id');
        });

        return redirect('/')->with('alert','Selamat! registrasi akun kamu berhasil. Silahkan login untuk lanjut belanja.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Pelanggan | Update Profil';
        $id_user = Auth::user()->id_user;
        //keranjang belanja
        $data['order'] = Order::where('id_user',$id_user)->get();
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        //alamat pelanggan
        $data['alamat'] = AlamatUser::join('provinsis','alamat_users.id_provinsi','provinsis.id_provinsi')
                            ->join('kotas','alamat_users.id_kota','kotas.id_kota')
                            ->where('id_user',$id_user)->get();
        //kategori produk
        $data['kategori'] = Kategori::all();
        //menu utaman
        $data['halaman'] = Halaman::all();
        return view('toko.pelanggan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $pelanggan
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
            'email' => 'required|email',
        ]);

        $user->update([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'gender' => $request->gender
        ]);

        return redirect('pelanggan')->with('alert','Berhasil mengubah profil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        //
    }

    public function ganti_foto(Request $request)
    {
        $id_user = Auth::user()->id_user;

        File::makeDirectory('img/user/'.$id_user.'/', 0777, true, true);

        $img = $request->file('avatar');
        $extension = $img->getClientOriginalExtension();  
        $destinationpath = 'img/user/'.$id_user.'/';
        $img_name = $id_user.'.'.$extension;
        //resize gambar
        $image_resize = Image::make($img->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save(public_path($destinationpath.''.$img_name));
        
        $user = User::find($id_user);

        $user->update([
            'avatar' => $destinationpath.''.$img_name
        ]);

        return redirect('pelanggan');
    }

    public function edit_password()
    {
        //konfigurasi toko
        $toko = $data['toko'] = Toko::find('1');
        $data['kontak'] = KontakToko::orderBy('urutan', 'asc')->orderby('created_at', 'asc')->get();
        $data['bank'] = Bank::all();
        //title
        $data['title'] = $toko->nama_toko.' | Pelanggan | Update Password ';
        
        $id_user = Auth::user()->id_user;
        //keranjang belanja
        $data['order'] = Order::where('id_user',$id_user)->get();
        $data['keranjang'] = Keranjang::where('id_user',Auth::user()->id_user)->get();
        //alamat pelanggan
        $data['alamat'] = AlamatUser::join('provinsis','alamat_users.id_provinsi','provinsis.id_provinsi')
                            ->join('kotas','alamat_users.id_kota','kotas.id_kota')
                            ->where('id_user',$id_user)->get();
        //kategori produk
        $data['kategori'] = Kategori::all();
        //menu utaman
        $data['halaman'] = Halaman::all();
        return view('toko.pelanggan.password.edit', compact('data'));
    }

    public function update_password(Request $request,$id)
    {
        //
        $user = User::find($id);
        
        if(!Hash::check($request->password_lama,$user->password))
        {
            return redirect('pelanggan/edit/password')->with('error','password salah');            
        }
        
        $this->validate($request, [
            'password_lama' => 'required|min:8',
            'password_baru' => 'required|min:8',
            'konfirmasi_password' => 'min:8|same:password_baru',
        ]);

        $user->update([
            'password' => Hash::make($request->password_baru)
        ]);

        return redirect('pelanggan')->with('alert', 'berhasil mengganti password');
    }

}
