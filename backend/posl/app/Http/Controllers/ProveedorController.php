<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Proveedor::with(['Articulo', 'Marca'])->where('estado', 1)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->nif = $request->nif;
        $proveedor->dirrecion = $request->dirrecion;
        $proveedor->contacto = $request->contacto;
        $proveedor->marca_id = $request->marca_id;
        $proveedor->articulo_id = $request->articulo_id;
        $proveedor->save();
        return $proveedor;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show(Proveedor $proveedor)
    {
        $proveedor->marca = $proveedor->Marca;//hace relacioón con marca
        $proveedor->medida = $proveedor->Medida;//hace relacioón con medida
        return $proveedor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->nombre;
        $proveedor->nif = $request->nif;
        $proveedor->dirrecion = $request->dirrecion;
        $proveedor->contacto = $request->contacto;
        $proveedor->marca_id = $request->marca_id;
        $proveedor->articulo_id = $request->articulo_id;
        $proveedor->save();
        return $proveedor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->estado = 0;
        $proveedor->save();
        return $proveedor;
    }
}
