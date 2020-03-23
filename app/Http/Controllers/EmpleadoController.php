<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmpleadoExport;

use App\Models\Empleado;
use App\Models\TipoUsuario;
use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Persona;
use App\Models\Profesion;
use App\Models\TipoSangre;
use App\Models\IdiomaEmpleado;
use App\Models\EmpleadoLicencia;
use App\Models\CategoriaLicencia;
use App\Models\EmpleadoLibreta;
use App\Models\EmpleadoCursoBomberil;
use App\Models\EmpleadoEducacion;
use App\Models\EmpleadoExperiencia;
use App\Models\EmpleadoInformacionBomberil;
use App\Models\EmpleadoCapacitacion;
use App\Models\EmpleadoAscenso;
use App\Models\EmpleadoCondecoracion;
use App\Models\EmpleadoNombramiento;
use App\Models\EmpleadoSancion;
use App\Models\Cargo;
use App\Models\Huella;
// use DB;
// EN OTRO METODO ESPECIAL:
// Traer a los demas modelos que hace parte del empleado(emplado_licencia, empleado... etc)
// Pues debemos agregar esa informacion a las tablas correspondientes
// Si ya tienes controlador, podemos llamar sus metodos, para no extender mas este.
// Log, EmpleadoLicencia, EmpleadoLibreta, EmpleadoExperiencia, EmpleadoEducacion

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // DB::enableQueryLog();
        $empleados = Empleado::all();
        foreach ($empleados as $empleado) {
            $nombramiento = EmpleadoNombramiento::where('empleado_nombramiento.id_empleado', '=', $empleado->id)
                                                ->where('empleado_nombramiento.activo', '=', 'Si')
                                                ->orderBy('id', 'DESC')
                                                ->first();
            if ($nombramiento) {
                $cargo = Cargo::find($nombramiento->id_cargo);
                $empleado->cargo = $cargo;
            } else {
                $empleado->cargo = null;
            }
            $tipoUsuario = TipoUsuario::find($empleado->id_tipo_usuario);
            $ciudad = Ciudad::find($empleado->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $persona = Persona::find($empleado->id_persona);
            $empleado->tipo_usuario = $tipoUsuario;
            $ciudad->departamento = $departamento;
            $empleado->ciudad = $ciudad;
            $empleado->persona = $persona;
            unset($empleado->id_tipo_usuario);
            unset($empleado->id_ciudad);
            unset($ciudad->id_departamento);
            unset($empleado->id_persona);
        }
        return $empleados;
    }

    public function curriculums() {
        $empleados = $this->index();
        foreach ($empleados as $empleado) {
            $id = $empleado->id;
            $empleado->cursos = EmpleadoCursoBomberil::where('empleado_curso_bomberil.id_empleado', '=', $id)->get();
            $empleado->educaciones = EmpleadoEducacion::join('ciudad', 'empleado_educacion.id_ciudad', '=', 'ciudad.id')
                                                        ->join('departamento', 'ciudad.id_departamento', '=', 'departamento.id')
                                                        ->where('empleado_educacion.id_empleado', '=', $id)
                                                        ->select('empleado_educacion.*', 'ciudad.nombre as ciudad', 'departamento.nombre as departamento')
                                                        ->get();
            $empleado->experiencias = EmpleadoExperiencia::where('empleado_experiencia.id_empleado', '=', $id)->get();
            $empleado->informaciones = EmpleadoInformacionBomberil::join('rango', 'empleado_informacion_bomberil.id_rango', '=', 'rango.id')
                                                                    ->where('empleado_informacion_bomberil.id_empleado', '=', $id)
                                                                    ->select('empleado_informacion_bomberil.*', 'rango.nombre as rango')
                                                                    ->get();
            $empleado->capacitaciones = EmpleadoCapacitacion::where('empleado_capacitacion.id_empleado', '=', $id)->get();
            $empleado->ascensos = EmpleadoAscenso::join('rango', 'empleado_ascenso.id_rango', '=', 'rango.id')
                                                    ->where('empleado_ascenso.id_empleado', '=', $id)
                                                    ->select('empleado_ascenso.*', 'rango.nombre as rango')
                                                    ->get();
            $empleado->condecoraciones = EmpleadoCondecoracion::join('tipo_condecoracion', 'empleado_condecoracion.id_tipo_condecoracion', '=', 'tipo_condecoracion.id')
                                                                ->where('empleado_condecoracion.id_empleado', '=', $id)
                                                                ->select('empleado_condecoracion.*', 'tipo_condecoracion.nombre as tipo_condecoracion')
                                                                ->get();
            $empleado->nombramientos = EmpleadoNombramiento::join('cargo', 'empleado_nombramiento.id_cargo', '=', 'cargo.id')
                                                            ->where('empleado_nombramiento.id_empleado', '=', $id)
                                                            ->select('empleado_nombramiento.*', 'cargo.nombre as cargo')
                                                            ->get();
            $empleado->sanciones = EmpleadoSancion::where('empleado_sancion.id_empleado', '=', $id)->get();
        }
        return $empleados;
    }

    public function curriculumPersonal($id) {
        $empleado = $this->show($id);
        if ($empleado) {
            $empleado->cursos = EmpleadoCursoBomberil::where('empleado_curso_bomberil.id_empleado', '=', $id)->get();
            $empleado->educaciones = EmpleadoEducacion::join('ciudad', 'empleado_educacion.id_ciudad', '=', 'ciudad.id')
                                                        ->join('departamento', 'ciudad.id_departamento', '=', 'departamento.id')
                                                        ->where('empleado_educacion.id_empleado', '=', $id)
                                                        ->select('empleado_educacion.*', 'ciudad.nombre as ciudad', 'departamento.nombre as departamento')
                                                        ->get();
            $empleado->experiencias = EmpleadoExperiencia::where('empleado_experiencia.id_empleado', '=', $id)->get();
            $empleado->informaciones = EmpleadoInformacionBomberil::join('rango', 'empleado_informacion_bomberil.id_rango', '=', 'rango.id')
                                                                    ->where('empleado_informacion_bomberil.id_empleado', '=', $id)
                                                                    ->select('empleado_informacion_bomberil.*', 'rango.nombre as rango')
                                                                    ->get();
            $empleado->capacitaciones = EmpleadoCapacitacion::where('empleado_capacitacion.id_empleado', '=', $id)->get();
            $empleado->ascensos = EmpleadoAscenso::join('rango', 'empleado_ascenso.id_rango', '=', 'rango.id')
                                                    ->where('empleado_ascenso.id_empleado', '=', $id)
                                                    ->select('empleado_ascenso.*', 'rango.nombre as rango')
                                                    ->get();
            $empleado->condecoraciones = EmpleadoCondecoracion::join('tipo_condecoracion', 'empleado_condecoracion.id_tipo_condecoracion', '=', 'tipo_condecoracion.id')
                                                                ->where('empleado_condecoracion.id_empleado', '=', $id)
                                                                ->select('empleado_condecoracion.*', 'tipo_condecoracion.nombre as tipo_condecoracion')
                                                                ->get();
            $empleado->nombramientos = EmpleadoNombramiento::join('cargo', 'empleado_nombramiento.id_cargo', '=', 'cargo.id')
                                                            ->where('empleado_nombramiento.id_empleado', '=', $id)
                                                            ->select('empleado_nombramiento.*', 'cargo.nombre as cargo')
                                                            ->get();
            $empleado->sanciones = EmpleadoSancion::where('empleado_sancion.id_empleado', '=', $id)->get();
            return $empleado;
        }
        return response('Registro no encontrado', 400)->header('Content-Type', 'text/plain');
    }

    public function inspectores()
    {
        $empleados = Empleado::join('tipo_usuario', 'empleado.id_tipo_usuario', '=', 'tipo_usuario.id')
                            ->where('tipo_usuario.slug', '=', 'supervisor')
                            ->select('empleado.*')
                            ->get();
        foreach ($empleados as $empleado) {
            $nombramiento = EmpleadoNombramiento::where('empleado_nombramiento.id_empleado', '=', $empleado->id)
                                                ->where('empleado_nombramiento.activo', '=', 'Si')
                                                ->orderBy('id', 'DESC')
                                                ->first();
            if ($nombramiento) {
                $cargo = Cargo::find($nombramiento->id_cargo);
                $empleado->cargo = $cargo;
            } else {
                $empleado->cargo = null;
            }
            $tipoUsuario = TipoUsuario::find($empleado->id_tipo_usuario);
            $ciudad = Ciudad::find($empleado->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $persona = Persona::find($empleado->id_persona);
            $empleado->tipo_usuario = $tipoUsuario;
            $ciudad->departamento = $departamento;
            $empleado->ciudad = $ciudad;
            $empleado->persona = $persona;
            unset($empleado->id_tipo_usuario);
            unset($empleado->id_ciudad);
            unset($ciudad->id_departamento);
            unset($empleado->id_persona);
        }
        return $empleados;
    }

    public function employeeWithoutAppointment() {
        $empleados = Empleado::leftJoin('empleado_nombramiento', 'empleado.id', '=', 'empleado_nombramiento.id_empleado')
                                ->where('empleado_nombramiento.id_empleado', '=', null)
                                ->select('empleado.*')
                                ->get();
        foreach ($empleados as $empleado) {
            $nombramiento = EmpleadoNombramiento::where('empleado_nombramiento.id_empleado', '=', $empleado->id)
                                                ->where('empleado_nombramiento.activo', '=', 'Si')
                                                ->orderBy('id', 'DESC')
                                                ->first();
            if ($nombramiento) {
                $cargo = Cargo::find($nombramiento->id_cargo);
                $empleado->cargo = $cargo;
            } else {
                $empleado->cargo = null;
            }
            $tipoUsuario = TipoUsuario::find($empleado->id_tipo_usuario);
            $ciudad = Ciudad::find($empleado->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $persona = Persona::find($empleado->id_persona);
            $empleado->tipo_usuario = $tipoUsuario;
            $ciudad->departamento = $departamento;
            $empleado->ciudad = $ciudad;
            $empleado->persona = $persona;
            unset($empleado->id_tipo_usuario);
            unset($empleado->id_ciudad);
            unset($ciudad->id_departamento);
            unset($empleado->id_persona);
        }
        return $empleados;
    }

    public function empleadosSinHuellas()  {
        $empleados = Empleado::leftJoin('huella', 'empleado.id', '=', 'huella.id_empleado')
                    ->where('huella.id_empleado', '=', null)
                    ->select('empleado.*')
                    ->get();
        foreach ($empleados as $empleado) {
            $persona = Persona::find($empleado->id_persona);
            $empleado->persona = $persona;
            unset($empleado->id_persona);
        }
        return $empleados;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idTipoUsuario = TipoUsuario::find($request['idTipoUsuario']);
        $idCiudad = Ciudad::find($request['idCiudad']);
        $idPersona = Persona::find($request['idPersona']);
        $idiomas = $request['idiomas'];
        $licencia = $request['licencia'];
        $libreta = $request['libreta'];
        if ($idTipoUsuario && $idCiudad && $idPersona) {
            $empleado = new Empleado;
            // $empleado->id = $empleado->id;
            $empleado->codigo = $request['codigo'];
            $empleado->codigo_sistema_nacional_npib = $request['codigoSistemaNacionalNpib'];
            // $empleado->password = bcrypt($request['password']);
            $empleado->password = Crypt::encryptString($request['password']);
            $empleado->fecha_ingreso = $request['fechaIngreso'];
            $empleado->activo = $request['activo'];
            $empleado->radicacion = $request['radicacion'];
            $empleado->pasaporte = $request['pasaporte'];
            $empleado->seguro = $request['seguro'];
            $empleado->tipo_casa = $request['tipoCasa'];
            $empleado->personas_a_cargo = $request['personasACargo'];
            $empleado->actividad = $request['actividad'];
            $empleado->labor = $request['labor'];
            $empleado->maquina = $request['maquina'];
            $empleado->computador = $request['computador'];
            $empleado->hobi = $request['hobi'];
            $empleado->id_tipo_usuario = $request['idTipoUsuario'];
            $empleado->id_ciudad = $request['idCiudad'];
            $empleado->id_persona = $request['idPersona'];
            $empleado->save();
            foreach ($idiomas as $idioma) {
                $idiomaEmpleado = new IdiomaEmpleado;
                $idiomaEmpleado->id_idioma = $idioma['id'];
                $idiomaEmpleado->id_empleado = $empleado->id;
                $idiomaEmpleado->save();
            }
            if ($licencia) {
                $empleadoLicencia = new EmpleadoLicencia;
                $empleadoLicencia->fecha_expedicion = $licencia['fechaExpedicion'];
                $empleadoLicencia->fecha_vigencia = $licencia['fechaVigencia'];
                $categoriaLicencia = $licencia['categoria'];
                $empleadoLicencia->id_categoria_licencia = $categoriaLicencia['id'];
                $empleadoLicencia->id_empleado = $empleado->id;
                $empleadoLicencia->save();
            }
            if ($libreta) {
                $empleadoLibreta = new EmpleadoLibreta;
                $empleadoLibreta->clase = $libreta['clase'];
                $empleadoLibreta->distrito = $libreta['distrito'];
                $empleadoLibreta->id_empleado = $empleado->id;
                $empleadoLibreta->save();
            }
            return $empleado;
        }
        return response('Datos faltantes', 400)->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        if ($empleado) {
            $idiomas = IdiomaEmpleado::join('idioma', 'idioma_empleado.id_idioma', '=', 'idioma.id')
                                        ->where('idioma_empleado.id_empleado', '=', $id)
                                        ->select('idioma.*')
                                        ->get();
            $libreta = EmpleadoLibreta::where('empleado_libreta.id_empleado', '=', $id)
                                    ->first();
            $licencia = EmpleadoLicencia::where('empleado_licencia.id_empleado', '=', $id)
                                        ->first();
            if ($licencia) {
                $categoriaLicencia = CategoriaLicencia::find($licencia['id_categoria_licencia']);
                $licencia->categoria = $categoriaLicencia;
                unset($licencia->id_categoria_licencia);
            }
            $nombramiento = EmpleadoNombramiento::where('empleado_nombramiento.id_empleado', '=', $empleado->id)
                                                ->where('empleado_nombramiento.activo', '=', 'Si')
                                                ->orderBy('id', 'DESC')
                                                ->first();
            if ($nombramiento) {
                $cargo = Cargo::find($nombramiento->id_cargo);
                $empleado->cargo = $cargo;
            } else {
                $empleado->cargo = null;
            }
            $tipoUsuario = TipoUsuario::find($empleado->id_tipo_usuario);
            $ciudad = Ciudad::find($empleado->id_ciudad);
            $departamento = Departamento::find($ciudad->id_departamento);
            $persona = Persona::find($empleado->id_persona);
            $persona->profesion = Profesion::find($persona->id_profesion);
            $persona->tipo_sangre = TipoSangre::find($persona->id_tipo_sangre);
            $ciudadNacimiento = Ciudad::find($persona->id_ciudad_nacimiento);
            $departamentoNacimiento = Departamento::find($ciudadNacimiento->id_departamento);
            $ciudadNacimiento->departamento = $departamentoNacimiento;
            $persona->ciudad_nacimiento = $ciudadNacimiento;
            $empleado->tipo_usuario = $tipoUsuario;
            $ciudad->departamento = $departamento;
            $empleado->ciudad = $ciudad;
            $empleado->persona = $persona;
            $empleado->password = Crypt::decryptString($empleado->password);
            unset($empleado->id_tipo_usuario);
            unset($empleado->id_ciudad);
            unset($ciudad->id_departamento);
            unset($empleado->id_persona);
            unset($persona->id_profesion);
            unset($persona->id_tipo_sangre);
            unset($persona->id_ciudad_nacimiento);
            unset($ciudadNacimiento->id_departamento);
            // tablas externas:
            $empleado->idiomas = $idiomas;
            $empleado->libreta = $libreta;
            $empleado->licencia = $licencia;
            return $empleado;
        }
        return response('Registro no encontrado', 400)->header('Content-Type', 'text/plain');
    }

    public function showHasFingerPrint($id) {
        $empleado = Empleado::find($id);
        $conHuella = Huella::where('huella.id_empleado', '=', $id)->get();
        return $conHuella ? $conHuella : [];
    }

    public function EmployeeValidForEdit($id) {
        $empleado = Empleado::find($id);
        if ($empleado->id_tipo_usuario == 1 || $empleado->id_tipo_usuario == 6) {
            return $empleado;
        }
        return [];
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
        $empleado = Empleado::find($id);
        // // Gestion de la licencia:
        $requestLicencia = $request['licencia'];
        $licencia = EmpleadoLicencia::where('empleado_licencia.id_empleado', '=', $id)
                                    ->first();
        if ($requestLicencia) {
            if($licencia) {
                $licencia->fecha_expedicion = isset($requestLicencia['fechaExpedicion']) ? $requestLicencia['fechaExpedicion'] : $licencia->fecha_expedicion;
                $licencia->fecha_vigencia = isset($requestLicencia['fechaVigencia']) ? $requestLicencia['fechaVigencia'] : $licencia->fecha_vigencia;
                $categoria = $requestLicencia['categoria'];
                $licencia->id_categoria_licencia = isset($categoria['id']) ? $categoria['id'] : $licencia->id_categoria_licencia;
                $licencia->save();
            } else {
                $empleadoLicencia = new EmpleadoLicencia;
                $empleadoLicencia->fecha_expedicion = $licencia['fechaExpedicion'];
                $empleadoLicencia->fecha_vigencia = $licencia['fechaVigencia'];
                $categoriaLicencia = $licencia['categoria'];
                $empleadoLicencia->id_categoria_licencia = $categoriaLicencia['id'];
                $empleadoLicencia->id_empleado = $empleado->id;
                $empleadoLicencia->save();
            }
        } else {
            if ($licencia) {
                $licencia->delete();
            }
        }
        // // Gestion de la libreta:
        $requestLibreta = $request['libreta'];
        $libreta = EmpleadoLibreta::where('empleado_libreta.id_empleado', '=', $id)
                                    ->first();
        if ($requestLibreta) {
            if($libreta) {
                $libreta->clase = isset($requestLibreta['clase']) ? $requestLibreta['clase'] : $libreta->clase;
                $libreta->distrito = isset($requestLibreta['distrito']) ? $requestLibreta['distrito'] : $libreta->distrito;
                $libreta->save();
            } else {
                $empleadoLibreta = new EmpleadoLibreta;
                $empleadoLibreta->clase = $requestLibreta['clase'];
                $empleadoLibreta->distrito = $requestLibreta['distrito'];
                $empleadoLibreta->id_empleado = $empleado->id;
                $empleadoLibreta->save();
            }
        } else {
            if ($libreta) {
                $libreta->delete();
            }
        }

        $requestIdiomas = $request['idiomas'];
        $idiomas = IdiomaEmpleado::where('idioma_empleado.id_empleado', '=', $id)
                                    ->get();
        foreach ($idiomas as $idioma) {
            $idioma->delete();
        }
        foreach ($requestIdiomas as $requestIdioma) {
            $idiomaEmpleado = new IdiomaEmpleado;
            $idiomaEmpleado->id_idioma = $requestIdioma['id'];
            $idiomaEmpleado->id_empleado = $id;
            $idiomaEmpleado->save();
        }
        $idTipoUsuario = $request['idTipoUsuario'];
        $idCiudad = $request['idCiudad'];
        $idPersona = $request['idPersona'];
        $validTipoUsuario = isset($idTipoUsuario) ? (TipoUsuario::find($idTipoUsuario) ? true : false) : true;
        $validCiudad = isset($idCiudad) ? (Ciudad::find($idCiudad) ? true : false) : true;
        $validPersona = isset($idPersona) ? (Persona::find($idPersona) ? true : false) : true;
        if ($empleado && $validTipoUsuario && $validCiudad && $validPersona) {
            $empleado->id = $empleado->id;
            $empleado->codigo = isset($request['codigo']) ? $request['codigo'] : $empleado->codigo;
            $empleado->codigo_sistema_nacional_npib = isset($request['codigoSistemaNacionalNpib']) ? $request['codigoSistemaNacionalNpib'] : $empleado->codigo_sistema_nacional_npib;
            // $empleado->password = isset($request['password']) ? bcrypt($request['password']) : $empleado->password;
            $empleado->password = isset($request['password']) ? Crypt::encryptString($request['password']) : $empleado->password;
            $empleado->fecha_ingreso = isset($request['fechaIngreso']) ? $request['fechaIngreso'] : $empleado->fecha_ingreso;
            $empleado->activo = isset($request['activo']) ? $request['activo'] : $empleado->activo;
            $empleado->radicacion = isset($request['radicacion']) ? $request['radicacion'] : $empleado->radicacion;
            $empleado->pasaporte = isset($request['pasaporte']) ? $request['pasaporte'] : $empleado->pasaporte;
            $empleado->seguro = isset($request['seguro']) ? $request['seguro'] : $empleado->seguro;
            $empleado->tipo_casa = isset($request['tipoCasa']) ? $request['tipoCasa'] : $empleado->tipo_casa;
            $empleado->personas_a_cargo = isset($request['personasACargo']) ? $request['personasACargo'] : $empleado->personas_a_cargo;
            $empleado->actividad = isset($request['actividad']) ? $request['actividad'] : $empleado->actividad;
            $empleado->labor = isset($request['labor']) ? $request['labor'] : $empleado->labor;
            $empleado->maquina = isset($request['maquina']) ? $request['maquina'] : $empleado->maquina;
            $empleado->computador = isset($request['computador']) ? $request['computador'] : $empleado->computador;
            $empleado->hobi = isset($request['hobi']) ? $request['hobi'] : $empleado->hobi;
            $empleado->id_tipo_usuario = isset($request['idTipoUsuario']) ? $request['idTipoUsuario'] : $empleado->id_tipo_usuario;
            $empleado->id_ciudad = isset($request['idCiudad']) ? $request['idCiudad'] : $empleado->id_ciudad;
            $empleado->id_persona = isset($request['idPersona']) ? $request['idPersona'] : $empleado->id_persona;
            $empleado->save();
            return $empleado;
        }
        return [];
    }

    public function updatePermissions(Request $request, $id) {
        $empleado = Empleado::find($id);
        if ($empleado) {
            $empleado->acceso_huella = isset($request['accesoHuella']) ? $request['accesoHuella'] : $empleado->acceso_huella;
            $empleado->save();
            return $empleado;
        }
        return [];
    }

    public function cancelFingerPrint() {
        $empleados = Empleado::all();
        foreach ($empleados as $empleado) {
            $empleado->acceso_huella = 0;
            $empleado->save();
        }
        return $empleados;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        if ($empleado) {
            $empleado->delete();
            return $empleado;
        }
        return [];
    }

    public function excelReport() {
        return new EmpleadoExport();
    }
}
