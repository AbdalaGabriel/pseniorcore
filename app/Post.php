<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
	protected $fillable = [
        'title', 'content', 'cover_image ', 'en_description', 'en_meta_description', 'meta_description', 'urlfriendly','en_urlfriendly', 'extract', 'en_extract'
    ];

    public function categories(){
    	 return $this->belongsToMany('App\Category', 'post_category');
    }
}
