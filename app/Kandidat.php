<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Sekolah;

class Kandidat extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'kandidats';


    protected $fillable = [
        'name', 'email', 'password', 'alamat', 'kota', 'provinsi', 'negara', 'tgl_lahir', 'tmp_lahir', 'avatar', 'sekolah_id', 'skills', 'pendidikan'
    ];

/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sekolah(){
        return $this->belongsTo(Sekolah::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

}
