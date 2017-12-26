<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loteria extends Model
{
	protected $table = 'loterias';

    protected $fillable = [
        'titulo', 'descripcion', 'activo', 'user_id',
    ];

    // Relacion uno a muchos user-mains
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Relacion uno a muchos main-numeros
    public function numeros()
    {
        return $this->hasMany('App\Numero');
    }
}
