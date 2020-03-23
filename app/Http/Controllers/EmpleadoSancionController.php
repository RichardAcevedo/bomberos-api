<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoSancionExport;

use App\Models\EmpleadoSancion;
use App\Models\Empleado;
use App\Models\Persona;

class EmpleadoSancionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoSanciones = EmpleadoSancion::all();
        foreach ($empleadoSanciones as $empleadoSancion) {
            $empleado = Empleado::find($empleadoSancion->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona;
            $empleadoSancion->empleado = $empleado;
            unset($empleadoSancion->id_empleado);
            unset($empleado->id_persona);
        }
        return $empleadoSanciones;
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
        if ($idEmpleado) {
            $empleadoSancion = new EmpleadoSancion;
            // $empleadoSancion->id = $empleadoSancion->id;
            $empleadoSancion->fecha = $request['fecha'];
            $empleadoSancion->tipo_sancion = $request['tipoSancion'];
            $empleadoSancion->orden = $request['orden'];
            $empleadoSancion->descripcion = $request['descripcion'];
            $empleadoSancion->id_empleado = $request['idEmpleado'];
            $empleadoSancion->save();
            return $empleadoSancion;
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
        $empleadoSancion = EmpleadoSancion::find($id);
        if ($empleadoSancion) {
            $empleado = Empleado::find($empleadoSancion->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona;
            $empleadoSancion->empleado = $empleado;
            unset($empleadoSancion->id_empleado);
            unset($empleado->id_persona);
            return $empleadoSancion;
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
        $empleadoSancion = EmpleadoSancion::find($id);
        $idEmpleado = $request['idEmpleado'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($empleadoSancion && $validEmpleado) {
            $empleadoSancion->id = $empleadoSancion->id;
            $empleadoSancion->fecha = isset($request['fecha']) ? $request['fecha'] : $empleadoSancion->fecha;
            $empleadoSancion->tipo_sancion = isset($request['tipoSancion']) ? $request['tipoSancion'] : $empleadoSancion->tipo_sancion;
            $empleadoSancion->orden = isset($request['orden']) ? $request['orden'] : $empleadoSancion->orden;
            $empleadoSancion->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $empleadoSancion->descripcion;
            $empleadoSancion->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoSancion->id_empleado;
            $empleadoSancion->save();
            return $empleadoSancion;
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
        $empleadoSancion = EmpleadoSancion::find($id);
        if ($empleadoSancion) {
            $empleadoSancion->delete();
            return $empleadoSancion;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoSancionExport();
    }
}
