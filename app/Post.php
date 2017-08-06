<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function user(){
    	return $this->belongsTo('App\User');
    }
    function likes(){
    	return $this->hasMany('App\Like');
    }
    function comments(){
    	return $this->hasMany('App\Comment');
    }
}
