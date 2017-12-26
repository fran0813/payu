<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $table = 'checks';

    protected $fillable = [
        'pago', 'loteria_id', 'user_id',
    ];

    // Relacion uno a muchos user-checks
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
