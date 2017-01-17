<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $fillable = [
        'title',
    ];

    public function projects(){
    	return $this->belongsToMany('App\Project', 'project_categories_projects');
    }
}
