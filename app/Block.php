<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'title', 'page_id', 'order', "description"
    ];

    public function posts(){
    	return $this->belongsTo('App\Page');
    }
}
