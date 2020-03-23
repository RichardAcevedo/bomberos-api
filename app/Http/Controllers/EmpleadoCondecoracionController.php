<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoCondecoracionExport;

use App\Models\EmpleadoCondecoracion;
use App\Models\Empleado;
use App\Models\TipoCondecoracion;
use App\Models\Persona;

class EmpleadoCondecoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoCondecoraciones = EmpleadoCondecoracion::all();
        foreach ($empleadoCondecoraciones as $empleadoCondecoracion) {
            $empleado = Empleado::find($empleadoCondecoracion->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona;
            $tipoCondecoracion = TipoCondecoracion::find($empleadoCondecoracion->id_tipo_condecoracion);
            $empleadoCondecoracion->empleado = $empleado;
            $empleadoCondecoracion->tipo_condecoracion = $tipoCondecoracion;
            unset($empleadoCondecoracion->id_empleado);
            unset($empleado->id_persona);
            unset($empleadoCondecoracion->id_tipo_condecoracion);
        }
        return $empleadoCondecoraciones;
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
        $idTipoCondecoracion = TipoCondecoracion::find($request['idTipoCondecoracion']);
        if ($idEmpleado && $idTipoCondecoracion) {
            $empleadoCondecoracion = new EmpleadoCondecoracion;
            // $empleadoCondecoracion->id = $empleadoCondecoracion->id;
            $empleadoCondecoracion->fecha_acta = $request['fechaActa'];
            $empleadoCondecoracion->fecha_resolucion = $request['fechaResolucion'];
            $empleadoCondecoracion->codigo_acta = $request['codigoActa'];
            $empleadoCondecoracion->codigo_resolucion = $request['codigoResolucion'];
            $empleadoCondecoracion->descripcion = $request['descripcion'];
            $empleadoCondecoracion->id_empleado = $request['idEmpleado'];
            $empleadoCondecoracion->id_tipo_condecoracion= $request['idTipoCondecoracion'];
            $empleadoCondecoracion->save();
            return $empleadoCondecoracion;
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
        $empleadoCondecoracion = EmpleadoCondecoracion::find($id);
        if ($empleadoCondecoracion) {
            $empleado = Empleado::find($empleadoCondecoracion->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona;
            $tipoCondecoracion = TipoCondecoracion::find($empleadoCondecoracion->id_tipo_condecoracion);
            $empleadoCondecoracion->empleado = $empleado;
            $empleadoCondecoracion->tipo_condecoracion = $tipoCondecoracion;
            unset($empleadoCondecoracion->id_empleado);
            unset($empleado->id_persona);
            unset($empleadoCondecoracion->id_tipo_condecoracion);
            return $empleadoCondecoracion;
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
        $empleadoCondecoracion = EmpleadoCondecoracion::find($id);
        $idEmpleado = $request['idEmpleado'];
        $idTipoCondecoracion = $request['idTipoCondecoracion'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        $validTipoCondecoracion = isset($idTipoCondecoracion) ? (TipoCondecoracion::find($idTipoCondecoracion) ? true : false) : true;
        if ($empleadoCondecoracion && $validEmpleado && $validTipoCondecoracion) {
            $empleadoCondecoracion->id = $empleadoCondecoracion->id;
            $empleadoCondecoracion->fecha_acta = isset($request['fechaActa']) ? $request['fechaActa'] : $empleadoCondecoracion->fecha_acta;
            $empleadoCondecoracion->fecha_resolucion = isset($request['fechaResolucion']) ? $request['fechaResolucion'] : $empleadoCondecoracion->fecha_resolucion;
            $empleadoCondecoracion->codigo_acta = isset($request['codigoActa']) ? $request['codigoActa'] : $empleadoCondecoracion->codigo_acta;
            $empleadoCondecoracion->codigo_resolucion = isset($request['codigoResolucion']) ? $request['codigoResolucion'] : $empleadoCondecoracion->codigo_resolucion;
            $empleadoCondecoracion->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $empleadoCondecoracion->descripcion;
            $empleadoCondecoracion->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoCondecoracion->id_empleado;
            $empleadoCondecoracion->id_tipo_condecoracion = isset($request['idTipoCondecoracion']) ? $request['idTipoCondecoracion'] : $empleadoCondecoracion->id_tipo_condecoracion;
            $empleadoCondecoracion->save();
            return $empleadoCondecoracion;
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
        $empleadoCondecoracion = EmpleadoCondecoracion::find($id);
        if ($empleadoCondecoracion) {
            $empleadoCondecoracion->delete();
            return $empleadoCondecoracion;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoCondecoracionExport();
    }
}
