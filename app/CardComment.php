<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardComment extends Model
{
   	
   	protected $fillable = [
        'comment', 'card_project_id', 'status', 'user_id', 'user_name'
    ];

    public function projects(){
    	return $this->belongsTo('App\CardProject');
    }

}
