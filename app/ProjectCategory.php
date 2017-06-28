<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCategory extends Model
{
    protected $fillable = [
        'title', 'en_title' , 'urlfriendly','en_urlfriendly'
    ];

    public function projects(){
    	return $this->belongsToMany('App\Project', 'project_categories_projects');
    }
}
