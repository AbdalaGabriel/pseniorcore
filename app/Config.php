<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public function pages(){
    	return $this->belongsTo('App\Page');
    }
}
