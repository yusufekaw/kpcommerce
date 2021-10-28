<?php

namespace App\Http\Controllers\Toko;

use App\AlamatPelanggan;
use App\Pelanggan;
use App\AlamatUser;
use App\User;
use App\Produk;
use App\Keranjang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class TokoController extends Controller
{
    //

    /*public function __construct()
    {

        $this->middleware('auth:pelanggan');
    }*/

   public function index()
    {
        //
        $cart;
        $produk_all = Produk::paginate(3);
        //$produk_all->setPath('toko');
        if(Auth::user())
        {
            $cart = Keranjang::join('produks','produks.id_produk','keranjangs.id_produk')->where('id_user',Auth::user()->id_user)->get();
            return view('toko.index',compact('produk_all', 'cart'));
        }
        else
        {
            return view('toko.index',compact('produk_all'));
        }
        
        
    }
}
