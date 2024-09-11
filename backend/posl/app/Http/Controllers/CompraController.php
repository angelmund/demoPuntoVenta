<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\CompraInventario;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra = Compra::where('estado', 1)->get(); //regresa los que tengan estado 1
        $list = [];
        foreach ($compra as $m) { //recorre el arreglo de compras para obtener su inventario y sumarlos 
           $list[] = $this->show($m); 
        
        }
        return $list;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $compra = new Compra();
        $compra->total = $request->total;
        $compra->tipo = $request->tipo;
        $compra->proveedor = $request->proveedor;
        $compra->motivo = $request->motivo;
        $compra->save();
        $numero = Compra::all()->count() + 1; //trae las compras y cuántos registros hay y le suma 1 ya que es lo que se compra  
        if (isset($request->carrito)) { //valida si existe carrito 
            if (!empty($request->carrito)) {
                foreach ($request->carrito as $m) {
                    $articulo = $m['articulo'];
                    //son los request que están en _id.vue en kardex, en el mtdo save
                    $inventario = new Inventario();
                    $inventario->articulo_id = $articulo['id']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->tipo = 1; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->compra = $articulo['compra']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->venta = $articulo['venta']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->cantidad = $m['cantidad']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->motivo = "COMPRA #" . $numero; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->save();

                    //hace que se guarde en inventario
                    $compraInventario = new CompraInventario();
                    $compraInventario->inventario_id = $inventario->id;
                    $compraInventario->compra_id = $compra->id;
                    $compraInventario->cantidad = $m['cantidad'];
                    $compraInventario->precio = $m['precio'];
                    $compraInventario->save();
                }
            }
        }
        return $compra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        $compra->compra_inventarios = $compra->CompraInventarios()->with(['Inventario' => function ($i) {
            $i->with(['Articulo' => function ($a) {
                $a->with(['Marca', 'Categoria', 'Medida']);
            }]);
        }])->get();
        $compra->fecha = $compra->created_at->format('d/m/Y');  //devuelve la fecha de compra
        return $compra;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        // cuando se presiona el botón de eliminar, desaparece de la vista y se cambia el estado a 0
        $compra->estado = 0;
        $compra->save();
    }
}
