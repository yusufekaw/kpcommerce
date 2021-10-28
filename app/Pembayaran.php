<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_pembayaran';
    
    protected $fillable = [
        'id_pembayaran', 'bank_tujuan', 'nama_bank', 'atas_nama', 'rekening', 'nominal' ,'bukti', 'id_order'
    ];
}
