<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutsAndResource extends Model
{
    protected $fillable = [
        'title', 'content', 'cover_image ', 'en_description', 'en_meta_description', 'meta_description', 'urlfriendly','en_urlfriendly', 'resource'
    ];

      public function categories(){
    	return $this->belongsToMany('App\TutsAndResourcesTag',  'tag_resource_tags');
    }
}
