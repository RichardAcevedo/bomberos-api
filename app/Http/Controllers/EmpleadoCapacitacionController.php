<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoCapacitacionExport;

use App\Models\EmpleadoCapacitacion;
use App\Models\Empleado;

class EmpleadoCapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmpleadoCapacitacion::all();
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
            $empleadoCapacitacion = new EmpleadoCapacitacion;
            // $empleadoCapacitacion->id = $empleadoCapacitacion->id;
            $empleadoCapacitacion->evento = $request['evento'];
            $empleadoCapacitacion->institucion = $request['institucion'];
            $empleadoCapacitacion->hora_teorica = $request['horaTeorica'];
            $empleadoCapacitacion->hora_practica = $request['horaPractica'];
            $empleadoCapacitacion->fecha = $request['fecha'];
            $empleadoCapacitacion->id_empleado = $request['idEmpleado'];
            if ($request->hasFile('archivo')){
                $file = $request->file('archivo');
                $name = "(".time().")".str_replace(" ", "_", $file->getClientOriginalName());
                $file->move(public_path().'/files/capacitaciones/', $name);
                $empleadoCapacitacion->dir_archivo = $name;
            }
            $empleadoCapacitacion->save();
            return $empleadoCapacitacion;
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
        $empleadoCapacitacion = EmpleadoCapacitacion::find($id);
        return isset($empleadoCapacitacion) ? $empleadoCapacitacion : [];
    }

    public function showForEmployee($idEmpleado)
    {
        $empleadoCapacitaciones = EmpleadoCapacitacion::where('empleado_capacitacion.id_empleado', '=', $idEmpleado)
                                                    ->get();
        return isset($empleadoCapacitaciones) ? $empleadoCapacitaciones : [];
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
        $empleadoCapacitacion = EmpleadoCapacitacion::find($id);
        $idEmpleado = $request['idEmpleado'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($empleadoCapacitacion && $validEmpleado) {
            $empleadoCapacitacion->id = $empleadoCapacitacion->id;
            $empleadoCapacitacion->evento = isset($request['evento']) ? $request['evento'] : $empleadoCapacitacion->evento;
            $empleadoCapacitacion->institucion = isset($request['institucion']) ? $request['institucion'] : $empleadoCapacitacion->institucion;
            $empleadoCapacitacion->hora_teorica = isset($request['horaTeorica']) ? $request['horaTeorica'] : $empleadoCapacitacion->hora_teorica;
            $empleadoCapacitacion->hora_practica = isset($request['horaPractica']) ? $request['horaPractica'] : $empleadoCapacitacion->hora_practica;
            $empleadoCapacitacion->fecha = isset($request['fecha']) ? $request['fecha'] : $empleadoCapacitacion->fecha;
            $empleadoCapacitacion->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoCapacitacion->id_empleado;
            if ($request->hasFile('archivo')){
                if ($empleadoCapacitacion->dir_archivo != null) {
                    unlink(public_path().'/files/capacitaciones/'.$empleadoCapacitacion->dir_archivo);
                }
                $file = $request->file('archivo');
                $name = "(".time().")".str_replace(" ", "_", $file->getClientOriginalName());
                $file->move(public_path().'/files/capacitaciones/', $name);
                $empleadoCapacitacion->dir_archivo = $name;
            }
            $empleadoCapacitacion->save();
            return $empleadoCapacitacion;
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
        $empleadoCapacitacion = EmpleadoCapacitacion::find($id);
        if ($empleadoCapacitacion) {
            if ($empleadoCapacitacion->dir_archivo) {
                unlink(public_path().'/files/capacitaciones/'.$empleadoCapacitacion->dir_archivo);
            }
            $empleadoCapacitacion->delete();
            return $empleadoCapacitacion;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoCapacitacionExport();
    }
}
