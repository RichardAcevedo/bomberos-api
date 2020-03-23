<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NovedadVehiculo;

class NovedadVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return NovedadVehiculo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $novedadVehiculo = new NovedadVehiculo;
        // $novedadVehiculo->id = $novedadVehiculo->id;
        $novedadVehiculo->nombre= $request['nombre'];
        $novedadVehiculo->save();
        return $novedadVehiculo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $novedadVehiculo = NovedadVehiculo::find($id);
        return isset($novedadVehiculo) ? $novedadVehiculo : [];
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
        $novedadVehiculo = NovedadVehiculo::find($id);
        if ($novedadVehiculo) {
            $novedadVehiculo->id = $novedadVehiculo->id;
            $novedadVehiculo->nombre = isset($request['nombre']) ? $request['nombre'] : $novedadVehiculo->nombre;
            $novedadVehiculo->save();
            return $novedadVehiculo;
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
        $novedadVehiculo = NovedadVehiculo::find($id);
        if ($novedadVehiculo) {
            $novedadVehiculo->delete();
            return $novedadVehiculo;
        }
        return [];
    }
}
