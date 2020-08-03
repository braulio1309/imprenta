<?php

namespace App;
use App\Pagos;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable = [
        'cliente_id', 'monto', 
    ];
}
