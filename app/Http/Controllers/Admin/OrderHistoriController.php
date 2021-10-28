<?php

namespace App\Http\Controllers\Admin;

use App\OrderHistori;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mail;
use Auth;


class OrderHistoriController extends Controller
{
    
    protected $redirectTo = '/admin';
    
    public function __construct()
    {
        $this->middleware('auth');        
    }
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrderHistori  $orderHistori
     * @return \Illuminate\Http\Response
     */
    public function show(OrderHistori $orderHistori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrderHistori  $orderHistori
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderHistori $orderHistori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrderHistori  $orderHistori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id/*OrderHistori $orderHistori*/)
    {
        //
        if(Auth::user()->role=='pelanggan')
        {
            return redirect('/');
        }
        $order = Order::find($id);
        $address = $request->email;
        if($request->verifikasi1)
        {
            $order->update([
                'kode_status' => '5',
                'status' => 'lunas',
            ]);
            OrderHistori::create([
                'id_order_histori' => 'oh'.date('ymdHis'),
                'id_order' => $id,
                'kode_status' => '5',
                'status' => 'lunas'
            ]);

            $mail = array(
                        'name'=>$request->nama_depan.' '.$request->nama_belakang,

                    );
            Mail::send('toko.mail.terima_pembayaran', $mail, function($message) use ($address){
                $message->to($address, 'member')->subject('Pembayaran ditolak');
                $message->from('ucup.smtp@gmail.com','jangan di bales');
            });  
        }
        else if($request->verifikasi2)
        {
            $order->update([
                'kode_status' => '4',
                'status' => 'pembayaran ditolak',
            ]);
            OrderHistori::create([
                'id_order_histori' => 'oh'.date('ymdHis'),
                'id_order' => $id,
                'kode_status' => '4',
                'status' => 'pembayaran ditolak'
            ]);


             $mail = array(
                        'name'=>$request->nama_depan.' '.$request->nama_belakang,

                    );
            Mail::send('toko.mail.tolak_pembayaran', $mail, function($message) use ($address){
                $message->to($address, 'member')->subject('Pembayaran ditolak');
                $message->from('ucup.smtp@gmail.com','jangan di bales');
            });   
        }
        else if($request->packing)
        {
            $order->update([
                'kode_status' => '6',
                'status' => 'packing',
            ]);
            OrderHistori::create([
                'id_order_histori' => 'oh'.date('ymdHis'),
                'id_order' => $id,
                'kode_status' => '6',
                'status' => 'packing'
            ]);

            $mail = array(
                        'name'=>$request->nama_depan.' '.$request->nama_belakang,

                    );
            Mail::send('toko.mail.packing', $mail, function($message) use ($address){
                $message->to($address, 'member')->subject('Pesanan sudah dipacking');
                $message->from('ucup.smtp@gmail.com','jangan di bales');
            });     
        }
        else
        {
            $order->update([
                'kode_status' => '7',
                'status' => 'dikirim',
            ]);
            OrderHistori::create([
                'id_order_histori' => 'oh'.date('ymdHis'),
                'id_order' => $id,
                'kode_status' => '7',
                'status' => 'dikirim'
            ]);

            $mail = array(
                        'name'=>$request->nama_depan.' '.$request->nama_belakang,

                    );
            Mail::send('toko.mail.kirim', $mail, function($message) use ($address){
                $message->to($address, 'member')->subject('Pesanan sudah dikirim');
                $message->from('ucup.smtp@gmail.com','jangan di bales');
            });

        }
        if($request->ref=='order_detail')
        {
            return redirect('admin/order/detail/'.$id)->with('success','ok');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrderHistori  $orderHistori
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderHistori $orderHistori)
    {
        //
    }
}
