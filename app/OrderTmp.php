<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTmp extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_order_tmp';

    protected $fillable = [
        'id_order_tmp', 'id_produk', 'id_user', 'qty',
    ];
}
