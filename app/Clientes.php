<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = [
        'name', 'departamento', 'email', 'domicilio', 
        'provincia', 'numero', 'piso', 'postal', 'telefono'

    ];
}
