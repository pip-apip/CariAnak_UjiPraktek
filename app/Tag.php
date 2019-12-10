<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tag';
    protected $fillable = ['id','name'];

    public function artikel()
    {
    	return $this->belongsToMany('App\Artikel');
    }

}
