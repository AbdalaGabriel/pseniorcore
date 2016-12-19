<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //si no tengo nombre convencional indicar ocmo parametro la tabal pivot
    public function posts(){
    	return $this->belongsToMany('App\Post',  'post_category');
    }
}
