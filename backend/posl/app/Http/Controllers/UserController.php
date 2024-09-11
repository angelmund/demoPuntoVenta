<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::where('estado', 1)->get();
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
        $usuario = new User();
        $usuario->nombre=$request->nombre;
        $usuario->username=$request->username;
        $usuario->email=$request->email;
        $usuario->password= Hash::make($request->password);
        $usuario->save();
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function show(User $medida)
    {
        return $medida;
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $medida)
    {
        $usuario = new User();
        $usuario->nombre=$request->nombre;
        $usuario->username=$request->username;
        $usuario->email=$request->email;
        if(isset($request->password)){
            if(!empty($request->password)){
                $usuario->password = Hash::make($request->password);
            }
        }
        $usuario->save();
        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medida  $medida
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $medida)
    {
        $medida->estado = 0;
        $medida->save();
        return $medida;
    }
}
