<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public function VentaInventarios(){ //tiene el detalle de la compra 
        return $this->hasMany(VentaInventario::class); //el movimiento va a tener muchos movimientos 
    }

}