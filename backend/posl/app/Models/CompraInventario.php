<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraInventario extends Model
{
    use HasFactory;
    public function Inventario(){
        return $this->belongsTo(Inventario::class); // 'marca_id' es la columna de clave foránea en la tabla 'articulos'
    }
      public function Compra(){
        return $this->belongsTo(Compra::class); // 'marca_id' es la columna de clave foránea en la tabla 'articulos'
    }
}
