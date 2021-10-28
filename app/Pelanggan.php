<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    //
    use Notifiable;
    
    public $incrementing = false;
    protected $primaryKey = 'id_pelanggan';

    protected $guard = 'pelanggan';

    protected $fillable = [
        'id_pelanggan', 'nama_depan', 'nama_belakang', 'gender', 'email', 'password'
    ];

    protected $hidden = [
    	'password', 'remember_token',
    ];
}
