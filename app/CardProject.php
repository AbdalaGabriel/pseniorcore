<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardProject extends Model
{
    protected $fillable = [
        'title', 'description', 'client_project_id', 'phase_id', 'status', 'task_order'
    ];

    public function projects(){
    	return $this->belongsTo('App\ClientProject');
    }

    public function phases(){
    	return $this->belongsTo('App\Phase');
    }
}
