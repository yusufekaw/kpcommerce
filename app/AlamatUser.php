<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlamatUser extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_alamat';

    protected $fillable = [
        'id_alamat', 'atas_nama', 'telp', 'jenis', 'jalan' ,'rt', 'rw', 'kelurahan', 'kecamatan', 'id_kota', 'kota', 'id_provinsi', 'provinsi','kodepos', 'id_user'
    ];

}
