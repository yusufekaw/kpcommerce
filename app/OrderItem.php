<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_order_item';

    protected $fillable = [
        'id_order_item', 'id_produk', 'qty', 'total_harga', 'id_order', 'catatan', 'berat_total'
    ];
}
