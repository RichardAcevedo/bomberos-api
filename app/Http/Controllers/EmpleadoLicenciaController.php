<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmpleadoLicencia;
use App\Models\CategoriaLicencia;
use App\Models\Empleado;

class EmpleadoLicenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EmpleadoLicencia::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idCategoriaLicencia = CategoriaLicencia::find($request['idCategoriaLicencia']);
        $idEmpleado = Empleado::find($request['idEmpleado']);
        if ($idCategoriaLicencia && $idEmpleado) {
            $empleadoLicencia = new EmpleadoLicencia;
            // $empleadoLicencia->id = $empleadoLicencia->id;
            $empleadoLicencia->fecha_expedicion = $request['fechaExpedicion'];
            $empleadoLicencia->fecha_vigencia = $request['fechaVigencia'];
            $empleadoLicencia->id_categoria_licencia= $request['idCategoriaLicencia'];
            $empleadoLicencia->id_empleado= $request['idEmpleado'];
            $empleadoLicencia->save();
            return $empleadoLicencia;
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
        $empleadoLicencia = EmpleadoLicencia::find($id);
        return isset($empleadoLicencia) ? $empleadoLicencia : [];
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
        $empleadoLicencia = EmpleadoLicencia::find($id);
        $idCategoriaLicencia = $request['idCategoriaLicencia'];
        $idEmpleado = $request['idEmpleado'];
        $validCategoriaLicencia = isset($idCategoriaLicencia) ? (CategoriaLicencia::find($idCategoriaLicencia) ? true : false) : true;
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($empleadoLicencia && $validCategoriaLicencia) {
            $empleadoLicencia->id = $empleadoLicencia->id;
            $empleadoLicencia->fecha_expedicion = isset($request['fechaExpedicion']) ? $request['fechaExpedicion'] : $empleadoLicencia->fecha_expedicion;
            $empleadoLicencia->fecha_vigencia = isset($request['fechaVigencia']) ? $request['fechaVigencia'] : $empleadoLicencia->fecha_vigencia;
            $empleadoLicencia->id_categoria_licencia = isset($request['idCategoriaLicencia']) ? $request['idCategoriaLicencia'] : $empleadoLicencia->id_categoria_licencia;
            $empleadoLicencia->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoLicencia->id_empleado;
            $empleadoLicencia->save();
            return $empleadoLicencia;
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
        $empleadoLicencia = EmpleadoLicencia::find($id);
        if ($empleadoLicencia) {
            $empleadoLicencia->delete();
            return $empleadoLicencia;
        }
        return [];
    }
}
