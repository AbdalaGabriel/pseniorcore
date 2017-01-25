<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardProject extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function projects(){
    	return $this->belongsTo('App\ClientProject');
    }

    public function phases(){
    	return $this->belongsTo('App\Phases');
    }
}
