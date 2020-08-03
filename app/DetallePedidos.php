<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetallePedidos extends Model
{
    protected $fillable = [
        'material_id', 'pedido_id', 'cantidad', 'precio'

    ];
}
