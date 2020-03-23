<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoNombramientoExport;

use App\Models\EmpleadoNombramiento;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Cargo;

class EmpleadoNombramientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoNombramientos = EmpleadoNombramiento::all();
        foreach ($empleadoNombramientos as $empleadoNombramiento) {
            $empleado = Empleado::find($empleadoNombramiento->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona;
            $cargo = Cargo::find($empleadoNombramiento->id_cargo);
            $empleadoNombramiento->empleado = $empleado;
            $empleadoNombramiento->cargo = $cargo;
            unset($empleadoNombramiento->id_empleado);
            unset($empleado->id_persona);
            unset($empleadoNombramiento->id_cargo);
        }
        return $empleadoNombramientos;
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
        $idCargo = Cargo::find($request['idCargo']);
        if ($idEmpleado && $idCargo) {
            $empleadoNombramiento = new EmpleadoNombramiento;
            // $empleadoNombramiento->id = $empleadoNombramiento->id;
            $empleadoNombramiento->fecha = $request['fecha'];
            $empleadoNombramiento->articulo = $request['articulo'];
            $empleadoNombramiento->orden = $request['orden'];
            $empleadoNombramiento->activo = $request['activo'];
            $empleadoNombramiento->fecha_desactivacion = $request['fechaDesactivacion'];
            $empleadoNombramiento->descripcion = $request['descripcion'];
            $empleadoNombramiento->id_cargo = $request['idCargo'];
            $empleadoNombramiento->id_empleado = $request['idEmpleado'];
            $empleadoNombramiento->save();
            return $empleadoNombramiento;
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
        $empleadoNombramiento = EmpleadoNombramiento::find($id);
        if ($empleadoNombramiento) {
            $empleado = Empleado::find($empleadoNombramiento->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona;
            $cargo = Cargo::find($empleadoNombramiento->id_cargo);
            $empleadoNombramiento->empleado = $empleado;
            $empleadoNombramiento->cargo = $cargo;
            unset($empleadoNombramiento->id_empleado);
            unset($empleado->id_persona);
            unset($empleadoNombramiento->id_cargo);
            return $empleadoNombramiento;
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
        $empleadoNombramiento = EmpleadoNombramiento::find($id);
        $idEmpleado = $request['idEmpleado'];
        $idCargo = $request['idCargo'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        $validCargo = isset($idCargo) ? (Cargo::find($idCargo) ? true : false) : true;
        if ($empleadoNombramiento && $validEmpleado && $validCargo) {
            $empleadoNombramiento->id = $empleadoNombramiento->id;
            $empleadoNombramiento->fecha = isset($request['fecha']) ? $request['fecha'] : $empleadoNombramiento->fecha;
            $empleadoNombramiento->articulo = isset($request['articulo']) ? $request['articulo'] : $empleadoNombramiento->articulo;
            $empleadoNombramiento->orden = isset($request['orden']) ? $request['orden'] : $empleadoNombramiento->orden;
            $empleadoNombramiento->activo = isset($request['activo']) ? $request['activo'] : $empleadoNombramiento->activo;
            $empleadoNombramiento->fecha_desactivacion = isset($request['fechaDesactivacion']) ? $request['fechaDesactivacion'] : $empleadoNombramiento->fecha_desactivacion;
            $empleadoNombramiento->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $empleadoNombramiento->descripcion;
            $empleadoNombramiento->id_cargo = isset($request['idCargo']) ? $request['idCargo'] : $empleadoNombramiento->id_cargo;
            $empleadoNombramiento->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoNombramiento->id_empleado;
            $empleadoNombramiento->save();
            return $empleadoNombramiento;
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
        $empleadoNombramiento = EmpleadoNombramiento::find($id);
        if ($empleadoNombramiento) {
            $empleadoNombramiento->delete();
            return $empleadoNombramiento;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoNombramientoExport();
    }
}
