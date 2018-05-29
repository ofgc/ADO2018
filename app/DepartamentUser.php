<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
//use App\Role;
use App\Departament;

class DepartamentUser extends Model
{
    
// Generada por jx para acceder a la tabla de usuarios relacionada con los departamentos

    protected $table = 'departament_user';


	public function departaments()
	    {
	        return $this
	            ->belongsToMany('App\Departament')
	    }

	public function user()
    {
        return $this
            ->belongsToMany('App\user')
    }
}
