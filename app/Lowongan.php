<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    protected $table = 'lowongan';

    public function perusahaan()
	{
		return $this->belongsTo('App\Perusahaan', 'id');
	}
}
