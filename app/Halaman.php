<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Halaman extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey  = 'id_halaman';
    protected $table  = 'halamans';

    protected $fillable = [
        'id_halaman','judul', 'konten'
    ];
}
