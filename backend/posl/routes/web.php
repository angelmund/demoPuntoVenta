<?php

use Illuminate\Support\Facades\Route;

//prefix, hace que se utilice el nombre 'api'
Route::group(['prefix'=> 'api'],function(){
    //se utiliza apiResource porque se tiene que acceder a cuatro metodos http, index,create,update, destroy
    Route::apiResource('/users', 'UserController');
    Route::apiResource('/marcas', 'MarcaController');
    Route::apiResource('/medidas', 'MedidaController');
    Route::apiResource('/categorias', 'CategoriaController');
    Route::apiResource('/articulos', 'ArticuloController'); //hace que dirija a las rutas de cada rubro
    Route::apiResource('/inventarios', 'InventarioController'); //hace que dirija a las rutas de cada rubro
    Route::apiResource('/proveedores', 'ProveedorController'); //hace que dirija a las rutas de cada rubro
    Route::get('/inventarios/kardex/{articulo}', 'InventarioController@kardex'); //hace que muestren los articulos en el kardex
    Route::apiResource('/compras', 'CompraController'); //hace que se llame la ruta para realizar una compra a un proveedor 
    Route::apiResource('/ventas', 'VentaController'); //hace que se llame la ruta para realizar una venta a un cliente
    Route::apiResource('/sucursales', 'SucursalController'); //llama al controlador con todos los metoos que tenga
});

Route::get('/', function () {
    return view('welcome');
});
