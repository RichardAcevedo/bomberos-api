<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoCursoBomberilExport;

use App\Models\EmpleadoCursoBomberil;
use App\Models\Empleado;

class EmpleadoCursoBomberilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmpleadoCursoBomberil::all();
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
            $empleadoCursoBomberil = new EmpleadoCursoBomberil;
            // $empleadoCursoBomberil->id = $empleadoCursoBomberil->id;
            $empleadoCursoBomberil->curso = $request['curso'];
            $empleadoCursoBomberil->fecha = $request['fecha'];
            $empleadoCursoBomberil->duracion = $request['duracion'];
            $empleadoCursoBomberil->institucion = $request['institucion'];
            $empleadoCursoBomberil->id_empleado = $request['idEmpleado'];
            $empleadoCursoBomberil->save();
            return $empleadoCursoBomberil;
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
        $empleadoCursoBomberil = EmpleadoCursoBomberil::find($id);
        return isset($empleadoCursoBomberil) ? $empleadoCursoBomberil : [];
    }

    public function showForEmployee($idEmpleado)
    {
        $empleadoCursosBomberiles = EmpleadoCursoBomberil::where('empleado_curso_bomberil.id_empleado', '=', $idEmpleado)
                                                    ->get();
        return isset($empleadoCursosBomberiles) ? $empleadoCursosBomberiles : [];
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
        $empleadoCursoBomberil = EmpleadoCursoBomberil::find($id);
        $idEmpleado = $request['idEmpleado'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($empleadoCursoBomberil && $validEmpleado) {
            $empleadoCursoBomberil->id = $empleadoCursoBomberil->id;
            $empleadoCursoBomberil->curso = isset($request['curso']) ? $request['curso'] : $empleadoCursoBomberil->curso;
            $empleadoCursoBomberil->fecha = isset($request['fecha']) ? $request['fecha'] : $empleadoCursoBomberil->fecha;
            $empleadoCursoBomberil->duracion = isset($request['duracion']) ? $request['duracion'] : $empleadoCursoBomberil->duracion;
            $empleadoCursoBomberil->institucion = isset($request['institucion']) ? $request['institucion'] : $empleadoCursoBomberil->institucion;
            $empleadoCursoBomberil->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoCursoBomberil->id_empleado;
            $empleadoCursoBomberil->save();
            return $empleadoCursoBomberil;
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
        $empleadoCursoBomberil = EmpleadoCursoBomberil::find($id);
        if ($empleadoCursoBomberil) {
            $empleadoCursoBomberil->delete();
            return $empleadoCursoBomberil;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoCursoBomberilExport();
    }
}
