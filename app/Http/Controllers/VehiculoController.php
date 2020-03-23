<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VehiculoExport;

use App\Models\Vehiculo;
use App\Models\TipoVehiculo;
use App\Models\VehiculoElemento;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        foreach ($vehiculos as $vehiculo) {
            $elementos = VehiculoElemento::join('elemento', 'vehiculo_elemento.id_elemento', '=', 'elemento.id')
                                        ->where('vehiculo_elemento.id_vehiculo', '=', $vehiculo->id)
                                        ->select('elemento.*')
                                        ->get();
            $vehiculo->elementos = $elementos;
            $tipoVehiculo = TipoVehiculo::find($vehiculo->id_tipo_vehiculo);
            $vehiculo->tipo_vehiculo = $tipoVehiculo;
            unset($vehiculo->id_tipo_vehiculo);
        }
        return $vehiculos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idTipoVehiculo = TipoVehiculo::find($request['idTipoVehiculo']);
        $elementos = $request['elementos'];
        if ($idTipoVehiculo) {
            $vehiculo = new Vehiculo;
            // $vehiculo->id = $vehiculo->id;
            $vehiculo->nombre= $request['nombre'];
            $vehiculo->marca= $request['marca'];
            $vehiculo->modelo= $request['modelo'];
            $vehiculo->placa= $request['placa'];
            $vehiculo->id_tipo_vehiculo= $request['idTipoVehiculo'];
            $vehiculo->save();
            foreach ($elementos as $elemento) {
                $vehiculoElemento = new VehiculoElemento;
                $vehiculoElemento->id_elemento = $elemento['id'];
                $vehiculoElemento->id_vehiculo = $vehiculo->id;
                $vehiculoElemento->save();
            }
            return $vehiculo;
        }
        return response('Datos faltantes', 400)->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehiculo = Vehiculo::find($id);
        if($vehiculo) {
            $elementos = VehiculoElemento::join('elemento', 'vehiculo_elemento.id_elemento', '=', 'elemento.id')
                                        ->where('vehiculo_elemento.id_vehiculo', '=', $id)
                                        ->select('elemento.*')
                                        ->get();
            $vehiculo->elementos = $elementos;
            $tipoVehiculo = TipoVehiculo::find($vehiculo->id_tipo_vehiculo);
            $vehiculo->tipo_vehiculo = $tipoVehiculo;
            unset($vehiculo->id_tipo_vehiculo);
            return $vehiculo;
        }
        return response('Registro no encontrado', 400)->header('Content-Type', 'text/plain');
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
        $vehiculo = Vehiculo::find($id);
        $idTipoVehiculo = $request['idTipoVehiculo'];
        $validTipoVehiculo = isset($idTipoVehiculo) ? (TipoVehiculo::find($idTipoVehiculo) ? true : false) : true;
        if ($vehiculo && $validTipoVehiculo) {
            $vehiculo->id = $vehiculo->id;
            $vehiculo->nombre = isset($request['nombre']) ? $request['nombre'] : $vehiculo->nombre;
            $vehiculo->marca = isset($request['marca']) ? $request['marca'] : $vehiculo->marca;
            $vehiculo->modelo = isset($request['modelo']) ? $request['modelo'] : $vehiculo->modelo;
            $vehiculo->placa = isset($request['placa']) ? $request['placa'] : $vehiculo->placa;
            $vehiculo->id_tipo_vehiculo = isset($request['idTipoVehiculo']) ? $request['idTipoVehiculo'] : $vehiculo->id_tipo_vehiculo;
            $vehiculo->save();
            $requestElementos = $request['elementos'];
            $elementos = VehiculoElemento::where('vehiculo_elemento.id_vehiculo', '=', $id)
                                        ->get();
            foreach ($elementos as $elemento) {
                $elemento->delete();
            }
            foreach ($requestElementos as $requestElemento) {
                $vehiculoElemento = new VehiculoElemento;
                $vehiculoElemento->id_elemento = $requestElemento['id'];
                $vehiculoElemento->id_vehiculo = $id;
                $vehiculoElemento->save();
            }
            return $vehiculo;
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
        $vehiculo = Vehiculo::find($id);
        if ($vehiculo) {
            $vehiculo->delete();
            return $vehiculo;
        }
        return [];
    }

    public function excelReport() {
        return new VehiculoExport();
    }
}
