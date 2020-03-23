<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Departamento;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudades = Ciudad::all();
        foreach ($ciudades as $ciudad) {
            $departamento = Departamento::find($ciudad->id_departamento);
            $ciudad->departamento = $departamento;
            unset($ciudad->id_departamento);
        }
        return $ciudades;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idDepartamento = Departamento::find($request['idDepartamento']);
        if ($idDepartamento) {
            $ciudad = new Ciudad;
            // $ciudad->id = $ciudad->id;
            $ciudad->nombre = $request['nombre'];
            $ciudad->id_departamento = $request['idDepartamento'];
            $ciudad->save();
            return $ciudad;
        }
        return [];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ciudad = Ciudad::find($id);
        return isset($ciudad) ? $ciudad : [];
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
        $ciudad = Ciudad::find($id);
        $idDepartamento = $request['idDepartamento'];
        $validDepartamento = isset($idDepartamento) ? (Departamento::find($idDepartamento) ? true : false) : true;
        if ($ciudad && $validDepartamento) {
            $ciudad->id = $ciudad->id;
            $ciudad->nombre = isset($request['nombre']) ? $request['nombre'] : $ciudad->nombre;
            $ciudad->id_departamento = isset($request['idDepartamento']) ? $request['idDepartamento'] : $ciudad->id_departamento;
            $ciudad->save();
            return $ciudad;
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
        $ciudad = Ciudad::find($id);
        if ($ciudad) {
            $ciudad->delete();
            return $ciudad;
        }
        return [];
    }
}
