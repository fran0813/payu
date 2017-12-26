<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numero extends Model
{
	protected $table = 'numeros';

    protected $fillable = [
        'numero', 'user_id', 'pago', 'loteria_id',
    ];

    // Relacion uno a muchos loteria-numeros
    public function loteria()
    {
        return $this->belongsTo('App\Loteria');
    }

    // Relacion uno a muchos numero-pagos
    public function pagos()
    {
        return $this->hasMany('App\Pago');
    }

}
