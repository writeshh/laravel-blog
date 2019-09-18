<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('App\Post');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
