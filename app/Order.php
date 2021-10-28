<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_order', 'id_user', 'kode_status', 'status'
    ];
}
