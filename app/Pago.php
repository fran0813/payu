<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
	protected $table = 'pagos';

    protected $fillable = [
        'numero_id',
    ];

    // Relacion uno a muchos numero-pagos
    public function numero()
    {
        return $this->belongsTo('App\Numero');
    }
}
