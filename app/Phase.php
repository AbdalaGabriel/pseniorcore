<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
   protected $fillable = [
        'title', 'description', 'client_project_id'
    ];

    public function project(){
    	return $this->belongsTo('App\ClientProject');
    }

    public function tasks(){
        return $this->hasMany('App\CardProject');
    }
}
