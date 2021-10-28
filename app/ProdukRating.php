<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukRating extends Model
{
    //
    public $incrementing = false;
    protected $primaryKey = 'id_rating';

    protected $fillable = [
        'id_rating', 'id_produk', 'id_user', 'nilai',
    ];
}
