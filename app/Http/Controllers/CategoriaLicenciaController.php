<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriaLicencia;

class CategoriaLicenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriaLicencia::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cargo = new CategoriaLicencia;
        // $cargo->id = $cargo->id;
        $cargo->nombre= $request['nombre'];
        $cargo->clase_vehiculo= $request['claseVehiculo'];
        $cargo->servicio= $request['servicio'];
        $cargo->save();
        return $cargo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cargo = CategoriaLicencia::find($id);
        return isset($cargo) ? $cargo : [];
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
        $cargo = CategoriaLicencia::find($id);
        if ($cargo) {
            $cargo->id = $cargo->id;
            $cargo->nombre = isset($request['nombre']) ? $request['nombre'] : $cargo->nombre;
            $cargo->clase_vehiculo = isset($request['claseVehiculo']) ? $request['claseVehiculo'] : $cargo->clase_vehiculo;
            $cargo->servicio = isset($request['servicio']) ? $request['servicio'] : $cargo->servicio;
            $cargo->save();
            return $cargo;
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
        $cargo = CategoriaLicencia::find($id);
        if ($cargo) {
            $cargo->delete();
            return $cargo;
        }
        return [];
    }
}
