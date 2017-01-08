<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    
    public function posts(){
    	return $this->belongsTo('App\Project');
    }
}
