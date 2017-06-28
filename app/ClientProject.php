<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProject extends Model
{
    protected $fillable = [
        'title', 'description', 'furl', 'user_id'
    ];

    public function users(){
    	return $this->belongsTo('App\User');
    }

    public function phases(){
        return $this->hasMany('App\Phase');
    }
}
