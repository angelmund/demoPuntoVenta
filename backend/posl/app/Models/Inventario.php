<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    public function Artiulo(){
        return $this->belongsTo(Categoria::class); //hace que se tenga acceso en el controladorInventario
    }
    public function articulo()
    {
        return $this->belongsTo(Articulo::class);
    }
}
