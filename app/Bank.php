<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_bank';


    protected $fillable = [
       'id_bank' ,'kode_bank', 'nama_bank', 'rekening', 'atas_nama', 'logo' 
    ];
}
