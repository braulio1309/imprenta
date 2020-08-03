<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedidos extends Model
{
    protected $fillable = [
        'cuenta_id', 'deuda', 'estatus'

    ];
}
