<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
	protected $table = 'artikel';
	protected $fillable = ['judul','foto','description','kategori','author'];	

    public function category()
	{
		return $this->belongsTo('App\Category', 'kategori');
	}

	public function comment(){
        return $this->belongsTo('App\Comment');
	}
	
	public function tag()
	{
		return $this->belongsToMany('App\Tag');
	}
}
