<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    //
    protected $primaryKey = 'id_provinsi';

    protected $fillable = [
        'nama_provinsi'
    ];
}
