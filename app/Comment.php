<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $fillable = ['post_id','author','message'];

    public function artikel()
    {
    	return $this->belongsTo('App\Artikel');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
