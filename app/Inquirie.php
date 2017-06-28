<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquirie extends Model
{
    protected $fillable = [ 'name','mail','number','message' ];
}
