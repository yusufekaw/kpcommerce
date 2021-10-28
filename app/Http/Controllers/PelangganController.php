<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\AlamatPelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Auth;

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
        $id_user = Auth::user()->id_user;
        $alamat = AlamatPelanggan::where('id_user',$id_user)->get();
        return view('toko.pelanggan.index', ['alamat' => $alamat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('toko.pelanggan.register');
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
        $id = 'c'.date('ymdhis'); 
        $this->validate($request, [
            'nama_depan' => 'required',
            'nama_belakang' => 'required',
            'gender' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'konfirmasi_password' => 'min:8|required_with:password|same:password',
        ]);

        Pelanggan::create([
            'id_pelanggan' => $id,
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' =>  Hash::make($request->password)
        ]);

        return redirect()->route('pelanggan')->with('success', 'Selamat jadi member brother');

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
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        //
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
}
