<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Inventario;
use App\Models\VentaInventario;
use Illuminate\Http\Request;

class VentaController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra = venta::where('estado', 1)->get(); //regresa los que tengan estado 1
        $list = [];
        foreach ($compra as $c) { //recorre el arreglo de compras para obtener su inventario y sumarlos 
           $list[] = $this->show($c); 
        
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
        //todos los objetos están en el diagrama 
        $venta = new Venta();
        $venta->total  = $request->total;
        $venta->pago  = $request->pago;
        $venta->cambio  = $request->cambio;
        $venta->tipo = $request->tipo;
        $venta->tipo = $request->tipo;
        $venta->cliente = $request->cliente;
        $venta->motivo = $request->motivo;
        $venta->save();
        $numero = Venta::all()->count() + 1; //trae las compras y cuántos registros hay y le suma 1 ya que es lo que se compra  
        if (isset($request->carrito)) { //valida si existe carrito 
            if (!empty($request->carrito)) {
                foreach ($request->carrito as $m) {
                    $articulo = $m['articulo'];
                    //son los request que están en _id.vue en kardex, en el mtdo save
                    $inventario = new Inventario();
                    $inventario->articulo_id = $articulo['id']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->tipo = 2; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->compra = $articulo['compra']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->venta = $articulo['venta']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->cantidad = $m['cantidad']; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->motivo = "Venta #" . $numero; //en vue.js, en el this.inventario.articulo_id, hacede para poder guardar 
                    $inventario->save();

                    //hace que se guarde en inventario
                    $ventaInventario = new VentaInventario();
                    $ventaInventario->inventario_id = $inventario->id;
                    $ventaInventario->venta_id = $venta->id;
                    $ventaInventario->cantidad = $m['cantidad'];
                    $ventaInventario->precio = $m['precio'];
                    $ventaInventario->save();
                }
            }
        }
        return $venta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(venta $venta)
    {
        $venta->venta_inventarios = $venta->VentaInventarios()->with(['Inventario' => function ($i) {
            $i->with(['Articulo' => function ($a) {
                $a->with(['Marca', 'Categoria', 'Medida']);
            }]);
        }])->get();
        $venta->fecha = $venta->created_at->format('d/m/Y');  //devuelve la fecha de compra
        return $venta;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(venta $venta)
    {
        // cuando se presiona el botón de eliminar, desaparece de la vista y se cambia el estado a 0
        $venta->estado = 0;
        $venta->save();
    }
}
