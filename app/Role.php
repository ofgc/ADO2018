<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
	{
	//establecimiento de la relacion de muchos a muchos con users	
	    return $this
	        ->belongsToMany('App\User')
	        ->withTimestamps();
	}
}
