<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarProduk extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_gambar';

    protected $fillable = [
        'id_gambar','path', 'id_produk',
    ];
}
