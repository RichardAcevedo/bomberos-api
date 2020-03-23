<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PersonaExport;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\TipoSangre;
use App\Models\Profesion;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personas = Persona::all();
        foreach ($personas as $persona) {
            $tipoSangre = TipoSangre::find($persona->id_tipo_sangre);
            $ciudadNacimiento = Ciudad::find($persona->id_ciudad_nacimiento);
            $departamentoNacimiento = Departamento::find($ciudadNacimiento->id_departamento);
            $profesion = Profesion::find($persona->id_profesion);
            $persona->tipo_sangre = $tipoSangre;
            $ciudadNacimiento->departamento = $departamentoNacimiento;
            $persona->ciudad_nacimiento = $ciudadNacimiento;
            $persona->profesion = $profesion;
            unset($persona->id_tipo_sangre);
            unset($persona->id_ciudad_nacimiento);
            unset($ciudadNacimiento->id_departamento);
            unset($persona->id_profesion);
        }
        return $personas;

    }

    public function personasNoEmpleadas() {
        $personas = Persona::leftJoin('empleado', 'persona.id', '=', 'empleado.id_persona')
                    ->where('empleado.id_persona', '=', null)
                    ->select('persona.*')
                    ->get();
        foreach ($personas as $persona) {
            $tipoSangre = TipoSangre::find($persona->id_tipo_sangre);
            $ciudadNacimiento = Ciudad::find($persona->id_ciudad_nacimiento);
            $departamentoNacimiento = Departamento::find($ciudadNacimiento->id_departamento);
            $profesion = Profesion::find($persona->id_profesion);
            $persona->tipo_sangre = $tipoSangre;
            $ciudadNacimiento->departamento = $departamentoNacimiento;
            $persona->ciudad_nacimiento = $ciudadNacimiento;
            $persona->profesion = $profesion;
            unset($persona->id_tipo_sangre);
            unset($persona->id_ciudad_nacimiento);
            unset($ciudadNacimiento->id_departamento);
            unset($persona->id_profesion);
        }
        return $personas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idTipoSangre = TipoSangre::find($request['idTipoSangre']);
        $idCiudadNacimiento = Ciudad::find($request['idCiudadNacimiento']);
        $idProfesion = Profesion::find($request['idProfesion']);
        if ($idTipoSangre && $idCiudadNacimiento  && $idProfesion) {
            $persona = new Persona;
            // $persona->id = $persona->id;
            $persona->nombre = $request['nombre'];
            $persona->fecha_nacimiento = $request['fechaNacimiento'];
            $persona->sexo = $request['sexo'];
            $persona->vive = $request['vive'];
            $persona->barrio = $request['barrio'];
            $persona->direccion = $request['direccion'];
            $persona->telefono = $request['telefono'];
            $persona->celular = $request['celular'];
            $persona->estado_civil = $request['estadoCivil'];
            $persona->documento = $request['documento'];
            $persona->estatura = $request['estatura'];
            $persona->peso = $request['peso'];
            $persona->email = $request['email'];
            $persona->fotografia= $request['fotografia'];
            $persona->id_tipo_sangre = $request['idTipoSangre'];
            $persona->id_ciudad_nacimiento = $request['idCiudadNacimiento'];
            $persona->id_profesion = $request['idProfesion'];
            $persona->save();
            return $persona;
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
        $persona = Persona::find($id);
        if ($persona) {
            $tipoSangre = TipoSangre::find($persona->id_tipo_sangre);
            $ciudadNacimiento = Ciudad::find($persona->id_ciudad_nacimiento);
            $departamentoNacimiento = Departamento::find($ciudadNacimiento->id_departamento);
            $profesion = Profesion::find($persona->id_profesion);
            $persona->tipo_sangre = $tipoSangre;
            $ciudadNacimiento->departamento = $departamentoNacimiento;
            $persona->ciudad_nacimiento = $ciudadNacimiento;
            $persona->profesion = $profesion;
            unset($persona->id_tipo_sangre);
            unset($persona->id_ciudad_nacimiento);
            unset($ciudadNacimiento->id_departamento);
            unset($persona->id_profesion);
            return $persona;
        }
        response('Registro no encontrado', 400)->header('Content-Type', 'text/plain');
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
        $persona = Persona::find($id);
        $idTipoSangre = $request['idTipoSangre'];
        $idCiudadNacimiento = $request['idCiudadNacimiento'];
        $idProfesion = $request['idProfesion'];
        $validTipoSangre = isset($idTipoSangre) ? (TipoSangre::find($idTipoSangre) ? true : false) : true;
        $validCiudadNacimiento = isset($idCiudadNacimiento) ? (Ciudad::find($idCiudadNacimiento) ? true : false) : true;
        $validProfesion = isset($idProfesion) ? (Profesion::find($idProfesion) ? true : false) : true;
        if ($persona && $validTipoSangre && $validCiudadNacimiento && $validProfesion) {
            $persona->id = $persona->id;
            $persona->nombre = isset($request['nombre']) ? $request['nombre'] : $persona->nombre;
            $persona->fecha_nacimiento = isset($request['fechaNacimiento']) ? $request['fechaNacimiento'] : $persona->fecha_nacimiento;
            $persona->sexo = isset($request['sexo']) ? $request['sexo'] : $persona->sexo;
            $persona->vive = isset($request['vive']) ? $request['vive'] : $persona->vive;
            $persona->barrio = isset($request['barrio']) ? $request['barrio'] : $persona->barrio;
            $persona->direccion = isset($request['direccion']) ? $request['direccion'] : $persona->direccion;
            $persona->telefono = isset($request['telefono']) ? $request['telefono'] : $persona->telefono;
            $persona->celular = isset($request['celular']) ? $request['celular'] : $persona->celular;
            $persona->estado_civil = isset($request['estadoCivil']) ? $request['estadoCivil'] : $persona->estado_civil;
            $persona->documento = isset($request['documento']) ? $request['documento'] : $persona->documento;
            $persona->estatura = isset($request['estatura']) ? $request['estatura'] : $persona->estatura;
            $persona->peso = isset($request['peso']) ? $request['peso'] : $persona->peso;
            $persona->email = isset($request['email']) ? $request['email'] : $persona->email;
            $persona->fotografia = isset($request['fotografia']) ? $request['fotografia'] : $persona->fotografia;
            $persona->id_tipo_sangre = isset($request['idTipoSangre']) ? $request['idTipoSangre'] : $persona->id_tipo_sangre;
            $persona->id_ciudad_nacimiento = isset($request['idCiudadNacimiento']) ? $request['idCiudadNacimiento'] : $persona->id_ciudad_nacimiento;
            $persona->id_profesion = isset($request['idProfesion']) ? $request['idProfesion'] : $persona->id_profesion;
            $persona->save();
            return $persona;
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
        $persona = Persona::find($id);
        if ($persona) {
            $persona->delete();
            return $persona;
        }
        return [];
    }

    public function excelReport() {
        return new PersonaExport();
    }
}
