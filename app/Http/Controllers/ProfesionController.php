<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesion;

class ProfesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Profesion::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profesion = new Profesion;
        // $profesion->id = $profesion->id;
        $profesion->nombre= $request['nombre'];
        $profesion->descripcion= $request['descripcion'];
        $profesion->save();
        return $profesion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profesion = Profesion::find($id);
        return isset($profesion) ? $profesion : [];
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
        $profesion = Profesion::find($id);
        if ($profesion) {
            $profesion->id = $profesion->id;
            $profesion->nombre = isset($request['nombre']) ? $request['nombre'] : $profesion->nombre;
            $profesion->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $profesion->descripcion;
            $profesion->save();
            return $profesion;
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
        $profesion = Profesion::find($id);
        if ($profesion) {
            $profesion->delete();
            return $profesion;
        }
        return [];
    }
}
