<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	// Relacion de usuarios
    public function users()
	{
	  return $this->belongsToMany('App\User');
	}
}
