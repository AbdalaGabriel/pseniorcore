<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    
	protected $fillable = [
        'name', 'project_id', 'order'
    ];

    public function posts(){
    	return $this->belongsTo('App\Project');
    }
}
