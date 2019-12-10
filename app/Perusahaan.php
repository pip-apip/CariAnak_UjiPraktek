<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Perusahaan extends Authenticatable
{
    
	use Notifiable;

    protected $guard = 'perusahaans';

    protected $fillable = [
        'name', 'email', 'password', 'alamat', 'telp', 'kota', 'provinsi', 'negara', 'avatar', 'website'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }
}
