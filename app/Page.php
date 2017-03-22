<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
     protected $fillable = [ 'title', 'urlfirendly', 'en_title', 'en_urlfriendly', 'jsoneditdata', 'htmleditdata'];

     public function configs(){
    	return $this->hasMany('App\Config');
    }
}
