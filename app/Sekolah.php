<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolah';

    protected $fillable = ['name'];

    public function kandidat(){
        return $this->hasMany(Kandidat::class);
    }
}
