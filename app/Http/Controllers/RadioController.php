<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RadioExport;

use App\Models\Radio;
use App\Models\Vehiculo;
use App\Models\TipoVehiculo;

class RadioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $radios = Radio::all();
        foreach ($radios as $radio) {
            $vehiculo = Vehiculo::find($radio->id_vehiculo);
            $radio->vehiculo = $vehiculo;
            unset($radio->id_vehiculo);
        }
        return $radios;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idVehiculo = Vehiculo::find($request['idVehiculo']);
        if ($idVehiculo) {
            $radio = new Radio;
            // $radio->id = $radio->id;
            $radio->serial = $request['serial'];
            $radio->marca = $request['marca'];
            $radio->estado = $request['estado'];
            $radio->señal = $request['señal'];
            $radio->tipo = $request['tipo'];
            $radio->id_vehiculo = $request['idVehiculo'];
            $radio->save();
            return $radio;
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
        $radio = Radio::find($id);
        if ($radio) {
            $vehiculo = Vehiculo::find($radio->id_vehiculo);
            $tipoVehiculo = TipoVehiculo::find($vehiculo->id_tipo_vehiculo);
            $vehiculo->tipo_vehiculo = $tipoVehiculo;
            $radio->vehiculo = $vehiculo;
            unset($radio->id_vehiculo);
            unset($vehiculo->id_tipo_vehiculo);
            return $radio;
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
        $radio = Radio::find($id);
        $idVehiculo = $request['idVehiculo'];
        $validVehiculo = isset($idVehiculo) ? (Vehiculo::find($idVehiculo) ? true : false) : true;
        if ($radio && $validVehiculo) {
            $radio->id = $radio->id;
            $radio->serial = isset($request['serial']) ? $request['serial'] : $radio->serial;
            $radio->marca = isset($request['marca']) ? $request['marca'] : $radio->marca;
            $radio->estado = isset($request['estado']) ? $request['estado'] : $radio->estado;
            $radio->señal = isset($request['señal']) ? $request['señal'] : $radio->señal;
            $radio->tipo = isset($request['tipo']) ? $request['tipo'] : $radio->tipo;
            $radio->id_vehiculo = isset($request['idVehiculo']) ? $request['idVehiculo'] : $radio->id_vehiculo;
            $radio->save();
            return $radio;
        }
        return response('Datos faltantes', 400)->header('Content-Type', 'text/plain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $radio = Radio::find($id);
        if ($radio) {
            $radio->delete();
            return $radio;
        }
        return [];
    }

    public function excelReport() {
        return new RadioExport();
    }
}
