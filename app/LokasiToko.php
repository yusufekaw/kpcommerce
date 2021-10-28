<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LokasiToko extends Model
{
    //
    protected $fillable = [
       'jalan' ,'rt', 'rw', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kodepos', 'latitude', 'longitude'
    ];
}
