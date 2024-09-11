<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Articulo;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= Articulo::where('estado', 1)->get();
        $list = [];
        foreach($model as $m) {
            $list[] = $this->kardex($m);
        }
        return $list;
    }

    public function kardex(Articulo $articulo)
    {
        $articulo->marca = $articulo->Marca;//hace relacioón con marca
        $articulo->medida = $articulo->Medida;//hace relacioón con medida
        $articulo->categoria = $articulo->Categoria;//hace relacioón con categoria
        $articulo->inventarios = $articulo->Inventarios()->where('estado',1)->get();//hace que invenatrios traiga los registros con estado 1
        $articulo->ingresos = $articulo->inventarios()->where('tipo',1)->sum('cantidad'); //muestra en ingresos, sumando los que son de tipo 1 más la cantidad
        $articulo->egresos = $articulo->inventarios()->where('tipo',2)->sum('cantidad'); //muestra en ingresos, sumando los que son de tipo 1 más la cantidad
        $articulo->stock = $articulo->ingresos - $articulo->egresos; //muestra en ingresos, sumando los que son de tipo 1 más la cantidad
        //son las operaciones que se hacen para calcular las ganancias, inversion y valor
        $articulo->valorizado = $articulo->stock * $articulo->venta;
        $articulo->inversion = $articulo->stock * $articulo->compra;
        $articulo->ganancia = $articulo->valorizado - $articulo->inversion; //termina 
        return $articulo;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //son los request que están en _id.vue en kardex, en el mtdo save
        $inventario =  new Inventario();
        $inventario->articulo_id = $request->articulo_id; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
        $inventario->tipo = $request->tipo; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
        $inventario->compra = $request->compra; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
        $inventario->venta = $request->venta; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
        $inventario->cantidad = $request->cantidad; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
        $inventario->motivo = $request->motivo; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
        $inventario->save();
        return $inventario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function show(Inventario $inventario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventario $inventario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventario  $inventario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventario $inventario)
    {
        //hace que se oculte a 0, es decir no se eliminia, solo se oculta en la vista, pero en la bd, está almacenado el registro
        $inventario->estado = 0;
        $inventario->save(); //esto lo hace en la vista de kardex  para eliminar los movimientos
    }
}
