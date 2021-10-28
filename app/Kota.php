<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    //
    protected $primaryKey = 'id_kota';

    protected $fillable = [
        'nama_kota', 'kode_pos', 'tipe', 'id_provinsi'
    ];
}
