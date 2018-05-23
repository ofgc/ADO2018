<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{

	protected $fillable = [
        'name', 'description',
    ];


   	public function credit()
    {
        return $this->hasMany('App\Credit');
    }
}
