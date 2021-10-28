<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarProduk extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_komentar_produk';

    protected $fillable = [
        'id_komentar_produk', 'id_produk', 'id_user', 'komentar', 'kode_status', 'status'
    ];
}