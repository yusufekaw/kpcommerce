<?php

namespace App\Http\Controllers\Toko;

use App\OrderTmp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class OrderTmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(Auth::user())
        {
             $cart = OrderTmp::join('produks','produks.id_produk','order_tmps.id_produk')->where('id_user',Auth::user()->id_user)->get();
            return view('toko.keranjang.index', compact('cart'));
        }
        else
        {
            return redirect('toko');
        }
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
    public function store($produk)
    {
        //
        OrderTmp::create([
            'id_order_tmp' => 'ot'.date('ymdhis'),
            'id_produk' => $produk,
            'id_user' => Auth::user()->id_user,
            'qty' => 1,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderTmp  $orderTmp
     * @return \Illuminate\Http\Response
     */
    public function show(OrderTmp $orderTmp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderTmp  $orderTmp
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderTmp $orderTmp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderTmp  $orderTmp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderTmp $orderTmp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderTmp  $orderTmp
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderTmp $orderTmp)
    {
        //
    }
}
