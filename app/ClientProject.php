<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProject extends Model
{
    protected $fillable = [
        'title', 'description', 'furl'
    ];

    public function posts(){
    	return $this->belongsTo('App\User');
    }
}
