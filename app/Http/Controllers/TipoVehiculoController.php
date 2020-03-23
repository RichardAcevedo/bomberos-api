<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TipoVehiculoExport;

use App\Models\TipoVehiculo;

class TipoVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoVehiculo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoVehiculo = new TipoVehiculo;
        // $tipoVehiculo->id = $tipoVehiculo->id;
        $tipoVehiculo->nombre= $request['nombre'];
        $tipoVehiculo->save();
        return $tipoVehiculo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoVehiculo = TipoVehiculo::find($id);
        return isset($tipoVehiculo) ? $tipoVehiculo : [];
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
        $tipoVehiculo = TipoVehiculo::find($id);
        if ($tipoVehiculo) {
            $tipoVehiculo->id = $tipoVehiculo->id;
            $tipoVehiculo->nombre = isset($request['nombre']) ? $request['nombre'] : $tipoVehiculo->nombre;
            $tipoVehiculo->save();
            return $tipoVehiculo;
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
        $tipoVehiculo = TipoVehiculo::find($id);
        if ($tipoVehiculo) {
            $tipoVehiculo->delete();
            return $tipoVehiculo;
        }
        return [];
    }

    public function excelReport() {
        return new TipoVehiculoExport();
    }
}
