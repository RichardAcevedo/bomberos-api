<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoInformacionBomberilExport;

use App\Models\EmpleadoInformacionBomberil;
use App\Models\Empleado;
use App\Models\Rango;
use App\Models\CategoriaRango;

class EmpleadoInformacionBomberilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleadoInformaciones = EmpleadoInformacionBomberil::all();
        foreach ($empleadoInformaciones as $empleadoInformacion) {
            $rango = Rango::find($empleadoInformacion->id_rango);
            $categoriaRango = CategoriaRango::find($rango->id_categoria_rango);
            $rango->categoria_rango = $categoriaRango;
            $empleadoInformacion->rango = $rango;
            unset($empleadoInformacion->id_rango);
            unset($rango->id_categoria_rango);
        }
        return $empleadoInformaciones;
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
            $empleadoInformacionBomberil = new EmpleadoInformacionBomberil;
            // $empleadoInformacionBomberil->id = $empleadoInformacionBomberil->id;
            $empleadoInformacionBomberil->fecha_inicio = $request['fechaInicio'];
            $empleadoInformacionBomberil->fecha_baja = $request['fechaBaja'];
            $empleadoInformacionBomberil->cargo = $request['cargo'];
            $empleadoInformacionBomberil->institucion = $request['institucion'];
            $empleadoInformacionBomberil->resolucion = $request['resolucion'];
            $empleadoInformacionBomberil->id_empleado = $request['idEmpleado'];
            $empleadoInformacionBomberil->id_rango = $request['idRango'];
            if ($request->hasFile('archivo')){
                $file = $request->file('archivo');
                $name = "(".time().")".str_replace(" ", "_", $file->getClientOriginalName());
                $file->move(public_path().'/files/informaciones/', $name);
                $empleadoInformacionBomberil->dir_archivo = $name;
            }
            $empleadoInformacionBomberil->save();
            return $empleadoInformacionBomberil;
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
        $empleadoInformacion = EmpleadoInformacionBomberil::find($id);
        if ($empleadoInformacion) {
            $rango = Rango::find($empleadoInformacion->id_rango);
            $categoriaRango = CategoriaRango::find($rango->id_categoria_rango);
            $rango->categoria_rango = $categoriaRango;
            $empleadoInformacion->rango = $rango;
            unset($empleadoInformacion->id_rango);
            unset($rango->id_categoria_rango);
            return $empleadoInformacion;
        }
        response('Registro no encontrado', 400)->header('Content-Type', 'text/plain');
    }

    public function showForEmployee($idEmpleado)
    {
        $empleadoInformaciones = EmpleadoInformacionBomberil::where('empleado_informacion_bomberil.id_empleado', '=', $idEmpleado)
                                                    ->get();
        foreach ($empleadoInformaciones as $empleadoInformacion) {
            $rango = Rango::find($empleadoInformacion->id_rango);
            $categoriaRango = CategoriaRango::find($rango->id_categoria_rango);
            $rango->categoria_rango = $categoriaRango;
            $empleadoInformacion->rango = $rango;
            unset($empleadoInformacion->id_rango);
            unset($rango->id_categoria_rango);
        }
        return $empleadoInformaciones;
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
        $empleadoInformacionBomberil = EmpleadoInformacionBomberil::find($id);
        $idEmpleado = $request['idEmpleado'];
        $idRango = $request['idRango'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        $validRango = isset($idRango) ? (Rango::find($idRango) ? true : false) : true;
        if ($empleadoInformacionBomberil && $validEmpleado && $validRango) {
            $empleadoInformacionBomberil->id = $empleadoInformacionBomberil->id;
            $empleadoInformacionBomberil->fecha_inicio = isset($request['fechaInicio']) ? $request['fechaInicio'] : $empleadoInformacionBomberil->fecha_inicio;
            $empleadoInformacionBomberil->fecha_baja = isset($request['fechaBaja']) ? $request['fechaBaja'] : $empleadoInformacionBomberil->fecha_baja;
            $empleadoInformacionBomberil->cargo = isset($request['cargo']) ? $request['cargo'] : $empleadoInformacionBomberil->cargo;
            $empleadoInformacionBomberil->institucion = isset($request['institucion']) ? $request['institucion'] : $empleadoInformacionBomberil->institucion;
            $empleadoInformacionBomberil->resolucion = isset($request['resolucion']) ? $request['resolucion'] : $empleadoInformacionBomberil->resolucion;
            $empleadoInformacionBomberil->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $empleadoInformacionBomberil->id_empleado;
            $empleadoInformacionBomberil->id_rango = isset($request['idRango']) ? $request['idRango'] : $empleadoInformacionBomberil->id_rango;
            if ($request->hasFile('archivo')){
                if ($empleadoInformacionBomberil->dir_archivo != null) {
                    unlink(public_path().'/files/informaciones/'.$empleadoInformacionBomberil->dir_archivo);
                }
                $file = $request->file('archivo');
                $name = "(".time().")".str_replace(" ", "_", $file->getClientOriginalName());
                $file->move(public_path().'/files/informaciones/', $name);
                $empleadoInformacionBomberil->dir_archivo = $name;
            }
            $empleadoInformacionBomberil->save();
            return $empleadoInformacionBomberil;
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
        $empleadoInformacionBomberil = EmpleadoInformacionBomberil::find($id);
        if ($empleadoInformacionBomberil) {
            if ($empleadoInformacionBomberil->dir_archivo) {
                unlink(public_path().'/files/informaciones/'.$empleadoInformacionBomberil->dir_archivo);
            }
            $empleadoInformacionBomberil->delete();
            return $empleadoInformacionBomberil;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoInformacionBomberilExport();
    }
}
