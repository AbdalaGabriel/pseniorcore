<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Project extends Model
{
    protected $fillable = [
        'title','description', 'cover_image ', 'en_description', 'en_meta_description', 'meta_description', 'urlfriendly', 'jsoneditdata', 'htmleditdata',  'en_jsoneditdata', 'en_htmleditdata'
    ];

    public function images(){
    	return $this->hasMany('App\ProjectImage');
    }

    public function projectsCategories(){
    	return $this->belongsToMany('App\ProjectCategory',  'project_categories_projects');
    }

    // Un mutador permite modificar elementos antes de ser guardados, en este caso lo utilizamos para 
    // modificar nombre de imagen si se llama igual a uno que ya se encuentra en la carpeta.

     public function setPathAttribute($path){
		$name = Carbon::now()->second.$path->getClientOriginalName();
		$this->attributes['path'] = $name;
		\Storage::disk('local')->put($name, \File::get($path));
	}
}

