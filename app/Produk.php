<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_produk';

    protected $fillable = [
        'id_produk', 'nama_produk', 'deskripsi', 'stok', 'harga', 'berat', 'gambar', 'id_kategori',
    ];
}
