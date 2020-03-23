<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmergenciaExport;

use App\Models\Emergencia;

class EmergenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Emergencia::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $emergencia = new Emergencia;
        // $emergencia->id = $emergencia->id;
        $emergencia->telefono= $request['telefono'];
        $emergencia->entidad= $request['entidad'];
        $emergencia->direccion= $request['direccion'];
        $emergencia->barrio= $request['barrio'];
        $emergencia->otro_telefono= $request['otroTelefono'];
        $emergencia->extension= $request['extension'];
        $emergencia->save();
        return $emergencia;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emergencia = Emergencia::find($id);
        return isset($emergencia) ? $emergencia : [];
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
        $emergencia = Emergencia::find($id);
        if ($emergencia) {
            $emergencia->id = $emergencia->id;
            $emergencia->telefono = isset($request['telefono']) ? $request['telefono'] : $emergencia->telefono;
            $emergencia->entidad = isset($request['entidad']) ? $request['entidad'] : $emergencia->entidad;
            $emergencia->direccion = isset($request['direccion']) ? $request['direccion'] : $emergencia->direccion;
            $emergencia->barrio = isset($request['barrio']) ? $request['barrio'] : $emergencia->barrio;
            $emergencia->barrio = isset($request['barrio']) ? $request['barrio'] : $emergencia->barrio;
            $emergencia->otro_telefono = isset($request['otroTelefono']) ? $request['otroTelefono'] : $emergencia->otro_telefono;
            $emergencia->extension = isset($request['extension']) ? $request['extension'] : $emergencia->extension;
            $emergencia->save();
            return $emergencia;
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
        $emergencia = Emergencia::find($id);
        if ($emergencia) {
            $emergencia->delete();
            return $emergencia;
        }
        return [];
    }

    public function excelReport() {
        return new EmergenciaExport();
    }
}
