<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    public function Marca(){
        return $this->belongsTo(Marca::class); // 'marca_id' es la columna de clave foránea en la tabla 'articulos'
    }
    public function Medida(){
        return $this->belongsTo(Medida::class);
    }
    public function Categoria(){
        return $this->belongsTo(Categoria::class);
    }
    public function Inventarios(){
        return $this->hasMany(Inventario::class); //el movimiento va a tener muchos movimientos 
    }
}
