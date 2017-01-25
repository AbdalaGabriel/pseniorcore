<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardProject extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function posts(){
    	return $this->belongsTo('App\ClientProject');
    }
}
