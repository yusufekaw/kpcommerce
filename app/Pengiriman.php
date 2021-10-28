<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_pengiriman';
    protected $table = 'pengirimans';

    protected $fillable = [
        'id_pengiriman', 'id_order', 'id_alamat'
    ];
}
