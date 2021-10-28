<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    //
     protected $fillable = [
       'nama_toko', 'tagline', 'deskripsi', 'logo' 
    ];
}
