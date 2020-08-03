<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentas extends Model
{
    protected $fillable = [
        'cliente_id', 'deuda', 

    ];
}
