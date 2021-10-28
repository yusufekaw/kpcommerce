<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey  = 'id_kategori';

    protected $fillable = [
        'id_kategori','nama_kategori'
    ];
}
