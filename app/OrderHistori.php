<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistori extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_order_histori';

    protected $fillable = [
        'id_order_histori', 'id_order', 'kode_status', 'status'
    ];
}
