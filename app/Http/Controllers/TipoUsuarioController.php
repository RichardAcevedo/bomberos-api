<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUsuario;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoUsuario::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoUsuario = new TipoUsuario;
        // $tipoUsuario->id = $tipoUsuario->id;
        $tipoUsuario->nombre= $request['nombre'];
        $tipoUsuario->save();
        return $tipoUsuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoUsuario = TipoUsuario::find($id);
        return isset($tipoUsuario) ? $tipoUsuario : [];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tipoUsuario = TipoUsuario::find($id);
        if ($tipoUsuario) {
            $tipoUsuario->id = $tipoUsuario->id;
            $tipoUsuario->nombre = isset($request['nombre']) ? $request['nombre'] : $tipoUsuario->nombre;
            $tipoUsuario->save();
            return $tipoUsuario;
        }
        return [];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tipoUsuario = TipoUsuario::find($id);
        if ($tipoUsuario) {
            $tipoUsuario->delete();
            return $tipoUsuario;
        }
        return [];
    }
}
