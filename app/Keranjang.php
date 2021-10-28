<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'id_keranjang', 'id_produk', 'id_user', 'qty', 'total_harga', 'catatan', 'berat_total'
    ];
}
