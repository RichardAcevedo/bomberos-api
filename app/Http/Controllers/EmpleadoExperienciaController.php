<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoExperienciaExport;

use App\Models\EmpleadoExperiencia;
use App\Models\Empleado;

class EmpleadoExperienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmpleadoExperiencia::all();
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
            $empleadoExperiencia = new EmpleadoExperiencia;
            // $empleadoExperiencia->id = $empleadoExperiencia->id;
            $empleadoExperiencia->empresa = $request['empresa'];
            $empleadoExperiencia->cargo = $request['cargo'];
            $empleadoExperiencia->direccion = $request['direccion'];
            $empleadoExperiencia->telefono = $request['telefono'];
            $empleadoExperiencia->jefe = $request['jefe'];
            $empleadoExperiencia->labores = $request['labores'];
            $empleadoExperiencia->fecha_ingreso = $request['fechaIngreso'];
            $empleadoExperiencia->fecha_retiro = $request['fechaRetiro'];
            $empleadoExperiencia->motivo = $request['motivo'];
            $empleadoExperiencia->verificacion = $request['verificacion'];
            $empleadoExperiencia->id_empleado = $request['idEmpleado'];
            $empleadoExperiencia->save();
            return $empleadoExperiencia;
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
        $empleadoExperiencia = EmpleadoExperiencia::find($id);
        return isset($empleadoExperiencia) ? $empleadoExperiencia : [];
    }

    public function showForEmployee($idEmpleado)
    {
        $empleadoExperiencias = EmpleadoExperiencia::where('empleado_experiencia.id_empleado', '=', $idEmpleado)
                                                    ->get();
        return isset($empleadoExperiencias) ? $empleadoExperiencias : [];
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
        $empleadoExperiencia = EmpleadoExperiencia::find($id);
        $idEmpleado = $request['idEmpleado'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($empleadoExperiencia && $validEmpleado) {
            $empleadoExperiencia->id = $empleadoExperiencia->id;
            $empleadoExperiencia->empresa = isset($request['empresa']) ? $request['empresa'] : $empleadoExperiencia->empresa;
            $empleadoExperiencia->cargo = isset($request['cargo']) ? $request['cargo'] : $empleadoExperiencia->cargo;
            $empleadoExperiencia->direccion = isset($request['direccion']) ? $request['direccion'] : $empleadoExperiencia->direccion;
            $empleadoExperiencia->telefono = isset($request['telefono']) ? $request['telefono'] : $empleadoExperiencia->telefono;
            $empleadoExperiencia->jefe = isset($request['jefe']) ? $request['jefe'] : $empleadoExperiencia->jefe;
            $empleadoExperiencia->labores = isset($request['labores']) ? $request['labores'] : $empleadoExperiencia->labores;
            $empleadoExperiencia->fecha_ingreso = isset($request['fechaIngreso']) ? $request['fechaIngreso'] : $empleadoExperiencia->fecha_ingreso;
            $empleadoExperiencia->fecha_retiro = isset($request['fechaRetiro']) ? $request['fechaRetiro'] : $empleadoExperiencia->fecha_retiro;
            $empleadoExperiencia->motivo = isset($request['motivo']) ? $request['motivo'] : $empleadoExperiencia->motivo;
            $empleadoExperiencia->verificacion = isset($request['verificacion']) ? $request['verificacion'] : $empleadoExperiencia->verificacion;
            $empleadoExperiencia->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoExperiencia->id_empleado;
            $empleadoExperiencia->save();
            return $empleadoExperiencia;
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
        $empleadoExperiencia = EmpleadoExperiencia::find($id);
        if ($empleadoExperiencia) {
            $empleadoExperiencia->delete();
            return $empleadoExperiencia;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoExperienciaExport();
    }
}
