<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpleadoLibreta;
use App\Models\Empleado;

class EmpleadoLibretaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmpleadoLibreta::all();
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
            $empleadoLibreta = new EmpleadoLibreta;
            // $empleadoLibreta->id = $empleadoLibreta->id;
            $empleadoLibreta->clase= $request['clase'];
            $empleadoLibreta->distrito= $request['distrito'];
            $empleadoLibreta->id_empleado= $request['idEmpleado'];
            $empleadoLibreta->save();
            return $empleadoLibreta;
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
        $empleadoLibreta = EmpleadoLibreta::find($id);
        return isset($empleadoLibreta) ? $empleadoLibreta : [];
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
        $empleadoLibreta = EmpleadoLibreta::find($id);
        $idEmpleado = $request['idEmpleado'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($empleadoLibreta && $validEmpleado) {
            $empleadoLibreta->id = $empleadoLibreta->id;
            $empleadoLibreta->clase = isset($request['clase']) ? $request['clase'] : $empleadoLibreta->clase;
            $empleadoLibreta->distrito = isset($request['distrito']) ? $request['distrito'] : $empleadoLibreta->distrito;
            $empleadoLibreta->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoLibreta->id_empleado;
            $empleadoLibreta->save();
            return $empleadoLibreta;
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
        $empleadoLibreta = EmpleadoLibreta::find($id);
        if ($empleadoLibreta) {
            $empleadoLibreta->delete();
            return $empleadoLibreta;
        }
        return [];
    }
}
