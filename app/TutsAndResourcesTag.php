<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutsAndResourcesTag extends Model
{
    protected $fillable = [
        'title', 'en_title', 'urlfriendly','en_urlfriendly'
    ];

     public function resources(){
    	return $this->belongsToMany('App\TutsAndResource',  'tag_resource_tags');
    }

}
