<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpresaExport;

use App\Models\Empresa;
use App\Models\Empleado;
use App\Models\Persona;
use App\Models\TipoEmpresa;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            $supervisor = Empleado::find($empresa->id_inspector);
            $persona = Persona::find($supervisor->id_persona);
            unset($supervisor->id_persona);
            $supervisor->persona = $persona;
            unset($empresa->id_inspector);
            $empresa->supervisor = $supervisor;
            $tipoEmpresa = TipoEmpresa::find($empresa->id_tipo_empresa);
            unset($empresa->id_tipo_empresa);
            $empresa->tipo_empresa = $tipoEmpresa;
        }
        return $empresas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idTipoEmpresa = TipoEmpresa::find($request['idTipoEmpresa']);
        $idInspector = Empleado::find($request['idInspector']);
        if ($idTipoEmpresa && $idInspector) {
            $empresa = new Empresa;
            // $empresa->id = $empresa->id;
            $empresa->nombre = $request['nombre'];
            $empresa->direccion = $request['direccion'];
            $empresa->barrio = $request['barrio'];
            $empresa->registro_camara = $request['registroCamara'];
            $empresa->telefono = $request['telefono'];
            $empresa->fecha_registro = $request['fechaRegistro'];
            $empresa->representante = $request['representante'];
            $empresa->celular = $request['celular'];
            $empresa->cedula = $request['cedula'];
            $empresa->nit = $request['nit'];
            $empresa->observacion = $request['observacion'];
            $empresa->sn = $request['sn'];
            $empresa->cantidad = $request['cantidad'];
            $empresa->area = $request['area'];
            $empresa->categoria = $request['categoria'];
            $empresa->nivel = $request['nivel'];
            $empresa->id_inspector = $request['idInspector'];
            $empresa->id_tipo_empresa= $request['idTipoEmpresa'];
            $empresa->save();
            return $empresa;
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
        $empresa = Empresa::find($id);
        if ($empresa) {
            $supervisor = Empleado::find($empresa->id_inspector);
            $persona = Persona::find($supervisor->id_persona);
            unset($supervisor->id_persona);
            $supervisor->persona = $persona;
            unset($empresa->id_inspector);
            $empresa->supervisor = $supervisor;
            $tipoEmpresa = TipoEmpresa::find($empresa->id_tipo_empresa);
            unset($empresa->id_tipo_empresa);
            $empresa->tipo_empresa = $tipoEmpresa;
            return $empresa;
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
        $empresa = Empresa::find($id);
        $idTipoEmpresa = $request['idTipoEmpresa'];
        $idInspector = $request['idInspector'];
        $validTipoEmpresa = isset($idTipoEmpresa) ? (TipoEmpresa::find($idTipoEmpresa) ? true : false) : true;
        $validEmpleadoInspector = isset($idInspector) ? (Empleado::find($idInspector) ? true : false) : true;
        if ($empresa && $validTipoEmpresa && $validEmpleadoInspector) {
            $empresa->id = $empresa->id;
            $empresa->nombre = isset($request['nombre']) ? $request['nombre'] : $empresa->nombre;
            $empresa->direccion = isset($request['direccion']) ? $request['direccion'] : $empresa->direccion;
            $empresa->barrio = isset($request['barrio']) ? $request['barrio'] : $empresa->barrio;
            $empresa->registro_camara = isset($request['registroCamara']) ? $request['registroCamara'] : $empresa->registro_camara;
            $empresa->telefono = isset($request['telefono']) ? $request['telefono'] : $empresa->telefono;
            $empresa->fecha_registro = isset($request['fechaRegistro']) ? $request['fechaRegistro'] : $empresa->fecha_registro;
            $empresa->representante = isset($request['representante']) ? $request['representante'] : $empresa->representante;
            $empresa->celular = isset($request['celular']) ? $request['celular'] : $empresa->celular;
            $empresa->cedula = isset($request['cedula']) ? $request['cedula'] : $empresa->cedula;
            $empresa->nit = isset($request['nit']) ? $request['nit'] : $empresa->nit;
            $empresa->observacion = isset($request['observacion']) ? $request['observacion'] : $empresa->observacion;
            $empresa->sn = isset($request['sn']) ? $request['sn'] : $empresa->sn;
            $empresa->cantidad = isset($request['cantidad']) ? $request['cantidad'] : $empresa->cantidad;
            $empresa->area = isset($request['area']) ? $request['area'] : $empresa->area;
            $empresa->categoria = isset($request['categoria']) ? $request['categoria'] : $empresa->categoria;
            $empresa->nivel = isset($request['nivel']) ? $request['nivel'] : $empresa->nivel;
            $empresa->id_inspector = isset($request['idInspector']) ? $request['idInspector'] : $empresa->id_inspector;
            $empresa->id_tipo_empresa = isset($request['idTipoEmpresa']) ? $request['idTipoEmpresa'] : $empresa->id_tipo_empresa;
            $empresa->save();
            return $empresa;
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
        $empresa = Empresa::find($id);
        if ($empresa) {
            $empresa->delete();
            return $empresa;
        }
        return [];
    }

    public function excelReport() {
        return new EmpresaExport();
    }
}
