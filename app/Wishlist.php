<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = "wishlists";

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function kandidat(){
        return $this->belongsTo(Kandidat::class);
    }
}
