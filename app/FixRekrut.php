<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FixRekrut extends Model
{
    protected $table = "fix_rekruts";

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function kandidat(){
        return $this->belongsTo(Kandidat::class);
    }
}
