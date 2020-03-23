<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoEducacionExport;

use App\Models\EmpleadoEducacion;
use App\Models\Empleado;
use App\Models\Ciudad;
use App\Models\Departamento;

class EmpleadoEducacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoEducaciones = EmpleadoEducacion::all();
        foreach ($empleadoEducaciones as $empleadoEducacion) {
            $ciudad = Ciudad::find($empleadoEducacion->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $ciudad->departamento = $departamento;
            $empleadoEducacion->ciudad = $ciudad;
            unset($empleadoEducacion->id_ciudad);
            unset($ciudad->id_departamento);
        }
        return $empleadoEducaciones;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idEmpleado = Empleado::find($request['idEmpleado']);
        $idCiudad = Ciudad::find($request['idCiudad']);
        if ($idEmpleado && $idCiudad) {
            $empleadoEducacion = new EmpleadoEducacion;
            // $empleadoEducacion->id = $empleadoEducacion->id;
            $empleadoEducacion->institucion = $request['institucion'];
            $empleadoEducacion->titulo_obtenido = $request['tituloObtenido'];
            $empleadoEducacion->fecha = $request['fecha'];
            $empleadoEducacion->terminado = $request['terminado'];
            $empleadoEducacion->id_empleado = $request['idEmpleado'];
            $empleadoEducacion->id_ciudad = $request['idCiudad'];
            $empleadoEducacion->save();
            return $empleadoEducacion;
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
        $empleadoEducacion = EmpleadoEducacion::find($id);
        if ($empleadoEducacion) {
            $ciudad = Ciudad::find($empleadoEducacion->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $ciudad->departamento = $departamento;
            $empleadoEducacion->ciudad = $ciudad;
            unset($empleadoEducacion->id_ciudad);
            unset($empleadoEducacion->id_departamento);
            return $empleadoEducacion;
        }
        response('Registro no encontrado', 400)->header('Content-Type', 'text/plain');
    }

    public function showForEmployee($idEmpleado)
    {
        $empleadoEducaciones = EmpleadoEducacion::where('empleado_educacion.id_empleado', '=', $idEmpleado)
                                                    ->get();
        foreach ($empleadoEducaciones as $empleadoEducacion) {
            $ciudad = Ciudad::find($empleadoEducacion->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $ciudad->departamento = $departamento;
            $empleadoEducacion->ciudad = $ciudad;
            unset($empleadoEducacion->id_ciudad);
            unset($empleadoEducacion->id_departamento);
        }
        return $empleadoEducaciones;
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
        $empleadoEducacion = EmpleadoEducacion::find($id);
        $idEmpleado = $request['idEmpleado'];
        $idCiudad = $request['idCiudad'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        $validCiudad = isset($idCiudad) ? (Ciudad::find($idCiudad) ? true : false) : true;
        if ($empleadoEducacion && $validEmpleado && $validCiudad) {
            $empleadoEducacion->id = $empleadoEducacion->id;
            $empleadoEducacion->institucion = isset($request['institucion']) ? $request['institucion'] : $empleadoEducacion->institucion;
            $empleadoEducacion->titulo_obtenido = isset($request['tituloObtenido']) ? $request['tituloObtenido'] : $empleadoEducacion->titulo_obtenido;
            $empleadoEducacion->fecha = isset($request['fecha']) ? $request['fecha'] : $empleadoEducacion->fecha;
            $empleadoEducacion->terminado = isset($request['terminado']) ? $request['terminado'] : $empleadoEducacion->terminado;
            $empleadoEducacion->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoEducacion->id_empleado;
            $empleadoEducacion->id_ciudad = isset($request['idCiudad']) ? $request['idCiudad'] : $empleadoEducacion->id_ciudad;
            $empleadoEducacion->save();
            return $empleadoEducacion;
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
        $empleadoEducacion = EmpleadoEducacion::find($id);
        if ($empleadoEducacion) {
            $empleadoEducacion->delete();
            return $empleadoEducacion;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoEducacionExport();
    }
}
