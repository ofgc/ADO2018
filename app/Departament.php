<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Departament extends Model
{

	protected $fillable = [
        'name', 'description',
    ];

	public function users()
		{
		//establecimiento de la relacion de muchos a muchos con users	
		    return $this
		        ->belongsToMany('App\User')
		        ->withTimestamps();
		}
}
