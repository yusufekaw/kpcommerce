<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodePengiriman extends Model
{
    //
    public $incrementing = false;
    protected $table = 'metode_pengirimans';
    protected $primaryKey = 'id_metode_pengiriman';

    protected $fillable = [
        'id_metode_pengiriman', 'id_pengiriman', 'kurir', 'layanan', 'berat', 'tarif'
    ];

}
