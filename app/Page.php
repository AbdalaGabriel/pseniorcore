<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
     protected $fillable = [ 'title', 'urlfirendly', 'en_title', 'en_urlfriendly', 'jsoneditdata', 'htmleditdata',  'en_jsoneditdata', 'en_htmleditdata', 'meta_description', 'en_meta_description'];

     public function configs(){
    	return $this->hasMany('App\Config');
    }
}
