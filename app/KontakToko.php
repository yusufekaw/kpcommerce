<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KontakToko extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_kontak';

    protected $fillable = [
       'id_kontak' ,'nama_kontak', 'jenis_kontak', 'kontak_info', 'urutan', 'ikon', 'link'
    ];
}
