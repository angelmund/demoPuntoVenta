<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    public function CompraInventarios(){ //tiene el detalle de la compra 
        return $this->hasMany(CompraInventario::class); //el movimiento va a tener muchos movimientos 
    }

}
