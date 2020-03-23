<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoAscensoExport;

use App\Models\EmpleadoAscenso;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\Rango;

class EmpleadoAscensoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoAscensos = EmpleadoAscenso::all();
        foreach ($empleadoAscensos as $empleadoAscenso) {
            $empleado = Empleado::find($empleadoAscenso->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $rango = Rango::find($empleadoAscenso->id_rango);
            $empleadoAscenso->empleado = $empleado;
            $empleadoAscenso->rango = $rango;
            $empleado->persona = $persona;
            unset($empleadoAscenso->id_empleado);
            unset($empleadoAscenso->id_rango);
            unset($empleado->id_persona);
        }
        return $empleadoAscensos;
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
        $idRango = Rango::find($request['idRango']);
        if ($idEmpleado && $idRango) {
            $empleadoAscenso = new EmpleadoAscenso;
            // $empleadoAscenso->id = $empleadoAscenso->id;
            $empleadoAscenso->fecha_acta = $request['fechaActa'];
            $empleadoAscenso->fecha_resolucion = $request['fechaResolucion'];
            $empleadoAscenso->codigo_acta = $request['codigoActa'];
            $empleadoAscenso->codigo_resolucion = $request['codigoResolucion'];
            $empleadoAscenso->descripcion = $request['descripcion'];
            $empleadoAscenso->activo = $request['activo'];
            $empleadoAscenso->fecha_desactivacion= $request['fechaDesactivacion'];
            $empleadoAscenso->id_empleado = $request['idEmpleado'];
            $empleadoAscenso->id_rango = $request['idRango'];
            if ($request->hasFile('archivo')){
                $file = $request->file('archivo');
                $name = "(".time().")".str_replace(" ", "_", $file->getClientOriginalName());
                $file->move(public_path().'/files/ascensos/', $name);
                $empleadoAscenso->dir_archivo = $name;
            }
            $empleadoAscenso->save();
            return $empleadoAscenso;
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
        $empleadoAscenso = EmpleadoAscenso::find($id);
        if ($empleadoAscenso) {
            $empleado = Empleado::find($empleadoAscenso->id_empleado);
            $persona = Persona::find($empleado->id_persona);
            $rango = Rango::find($empleadoAscenso->id_rango);
            $empleado->persona = $persona;
            $empleadoAscenso->empleado = $empleado;
            $empleadoAscenso->rango = $rango;
            unset($empleadoAscenso->id_empleado);
            unset($empleadoAscenso->id_rango);
            unset($empleado->id_persona);
            return $empleadoAscenso;
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
        $empleadoAscenso = EmpleadoAscenso::find($id);
        $idEmpleado = $request['idEmpleado'];
        $idRango = $request['idRango'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        $validRango = isset($idRango) ? (Rango::find($idRango) ? true : false) : true;
        if ($empleadoAscenso && $validEmpleado && $validRango) {
            $empleadoAscenso->id = $empleadoAscenso->id;
            $empleadoAscenso->fecha_acta = isset($request['fechaActa']) ? $request['fechaActa'] : $empleadoAscenso->fecha_acta;
            $empleadoAscenso->fecha_resolucion = isset($request['fechaResolucion']) ? $request['fechaResolucion'] : $empleadoAscenso->fecha_resolucion;
            $empleadoAscenso->codigo_acta = isset($request['codigoActa']) ? $request['codigoActa'] : $empleadoAscenso->codigo_acta;
            $empleadoAscenso->codigo_resolucion = isset($request['codigoResolucion']) ? $request['codigoResolucion'] : $empleadoAscenso->codigo_resolucion;
            $empleadoAscenso->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $empleadoAscenso->descripcion;
            $empleadoAscenso->activo = isset($request['activo']) ? $request['activo'] : $empleadoAscenso->activo;
            $empleadoAscenso->fecha_desactivacion = isset($request['fechaDesactivacion']) ? $request['fechaDesactivacion'] : $empleadoAscenso->fecha_desactivacion;
            $empleadoAscenso->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoAscenso->id_empleado;
            $empleadoAscenso->id_rango = isset($request['idRango']) ? $request['idRango'] : $empleadoAscenso->id_rango;
            if ($request->hasFile('archivo')){
                if ($empleadoAscenso->dir_archivo != null) {
                    unlink(public_path().'/files/ascensos/'.$empleadoAscenso->dir_archivo);
                }
                $file = $request->file('archivo');
                $name = "(".time().")".str_replace(" ", "_", $file->getClientOriginalName());
                $file->move(public_path().'/files/ascensos/', $name);
                $empleadoAscenso->dir_archivo = $name;
            }
            $empleadoAscenso->save();
            return $empleadoAscenso;
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
        $empleadoAscenso = EmpleadoAscenso::find($id);
        if ($empleadoAscenso) {
            if ($empleadoAscenso->dir_archivo) {
                unlink(public_path().'/files/ascensos/'.$empleadoAscenso->dir_archivo);
            }
            $empleadoAscenso->delete();
            return $empleadoAscenso;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoAscensoExport();
    }
}
