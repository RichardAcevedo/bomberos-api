<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PATCH, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('log2')->group(function () {
    Route::get('/', 'LogController2@index');
    Route::get('/excel/reporte', 'LogController2@excelReport');
});

Route::prefix('emergency')->group(function () {
    Route::get('/', 'EmergencyController@index');
    Route::get('/excel/reporte', 'EmergencyController@excelReport');
});

Route::prefix('emergencia')->group(function () {
    Route::get('/', 'EmergenciaController@index');
    Route::post('/new', 'EmergenciaController@store');// (datos en body)
    Route::get('/{id}', 'EmergenciaController@show');
    Route::patch('/{id}', 'EmergenciaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmergenciaController@destroy');
    Route::get('/excel/reporte', 'EmergenciaController@excelReport');
});

Route::prefix('directorio')->group(function () {
    Route::get('/', 'DirectorioController@index');
    Route::post('/new', 'DirectorioController@store');// (datos en body)
    Route::get('/{id}', 'DirectorioController@show');
    Route::patch('/{id}', 'DirectorioController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'DirectorioController@destroy');
    Route::get('/excel/reporte', 'DirectorioController@excelReport');
});

Route::prefix('adodb-logsql')->group(function () {
    Route::get('/', 'AdodbLogSQLController@index');
    Route::post('/new', 'AdodbLogSQLController@store');// (datos en body)
    Route::get('/{id}', 'AdodbLogSQLController@show');
    Route::patch('/{id}', 'AdodbLogSQLController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'AdodbLogSQLController@destroy');
});

Route::prefix('tipo-vehiculo')->group(function () {
    Route::get('/', 'TipoVehiculoController@index');
    Route::post('/new', 'TipoVehiculoController@store');// (datos en body)
    Route::get('/{id}', 'TipoVehiculoController@show');
    Route::patch('/{id}', 'TipoVehiculoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'TipoVehiculoController@destroy');
    Route::get('/excel/reporte', 'TipoVehiculoController@excelReport');
});

Route::prefix('tipo-empresa')->group(function () {
    Route::get('/', 'TipoEmpresaController@index');
    Route::post('/new', 'TipoEmpresaController@store');// (datos en body)
    Route::get('/{id}', 'TipoEmpresaController@show');
    Route::patch('/{id}', 'TipoEmpresaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'TipoEmpresaController@destroy');
    Route::get('/excel/reporte', 'TipoEmpresaController@excelReport');
});

Route::prefix('elemento')->group(function () {
    Route::get('/', 'ElementoController@index');
    Route::get('/sin-vehiculo', 'ElementoController@getElementsAlone');
    Route::post('/new', 'ElementoController@store');// (datos en body)
    Route::get('/{id}', 'ElementoController@show');
    Route::patch('/{id}', 'ElementoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'ElementoController@destroy');
    Route::get('/excel/reporte', 'ElementoController@excelReport');
});

Route::prefix('categoria-rango')->group(function () {
    Route::get('/', 'CategoriaRangoController@index');
    Route::post('/new', 'CategoriaRangoController@store');// (datos en body)
    Route::get('/{id}', 'CategoriaRangoController@show');
    Route::patch('/{id}', 'CategoriaRangoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'CategoriaRangoController@destroy');
    Route::get('/excel/reporte', 'CategoriaRangoController@excelReport');
});

Route::prefix('cargo')->group(function () {
    Route::get('/', 'CargoController@index');
    Route::post('/new', 'CargoController@store');// (datos en body)
    Route::get('/{id}', 'CargoController@show');
    Route::get('/disponibles/{id}', 'CargoController@getAvailables');
    Route::patch('/{id}', 'CargoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'CargoController@destroy');
    Route::get('/excel/reporte', 'CargoController@excelReport');
});

Route::prefix('tipo-condecoracion')->group(function () {
    Route::get('/', 'TipoCondecoracionController@index');
    Route::post('/new', 'TipoCondecoracionController@store');// (datos en body)
    Route::get('/{id}', 'TipoCondecoracionController@show');
    Route::patch('/{id}', 'TipoCondecoracionController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'TipoCondecoracionController@destroy');
    Route::get('/excel/reporte', 'TipoCondecoracionController@excelReport');
});

Route::prefix('cliente')->group(function () {
    Route::get('/', 'ClienteController@index');
    Route::post('/new', 'ClienteController@store');// (datos en body)
    Route::get('/{id}', 'ClienteController@show');
    Route::patch('/{id}', 'ClienteController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'ClienteController@destroy');
    Route::get('/excel/reporte', 'ClienteController@excelReport');
});

Route::prefix('tipo-extintor')->group(function () {
    Route::get('/', 'TipoExtintorController@index');
    Route::post('/new', 'TipoExtintorController@store');// (datos en body)
    Route::get('/{id}', 'TipoExtintorController@show');
    Route::patch('/{id}', 'TipoExtintorController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'TipoExtintorController@destroy');
    Route::get('/excel/reporte', 'TipoExtintorController@excelReport');
});

Route::prefix('asunto')->group(function () {
    Route::get('/', 'AsuntoController@index');
    Route::post('/new', 'AsuntoController@store');// (datos en body)
    Route::get('/{id}', 'AsuntoController@show');
    Route::get('/nombre/{name}', 'AsuntoController@showForName');
    Route::patch('/{id}', 'AsuntoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'AsuntoController@destroy');
    Route::get('/excel/reporte', 'AsuntoController@excelReport');
});

Route::prefix('evento')->group(function () {
    Route::get('/', 'EventoController@index');
    Route::post('/new', 'EventoController@store');// (datos en body)
    Route::get('/{id}', 'EventoController@show');
    Route::patch('/{id}', 'EventoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EventoController@destroy');
});

Route::prefix('novedad-vehiculo')->group(function () {
    Route::get('/', 'NovedadVehiculoController@index');
    Route::post('/new', 'NovedadVehiculoController@store');// (datos en body)
    Route::get('/{id}', 'NovedadVehiculoController@show');
    Route::patch('/{id}', 'NovedadVehiculoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'NovedadVehiculoController@destroy');
});

Route::prefix('profesion')->group(function () {
    Route::get('/', 'ProfesionController@index');
    Route::post('/new', 'ProfesionController@store');// (datos en body)
    Route::get('/{id}', 'ProfesionController@show');
    Route::patch('/{id}', 'ProfesionController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'ProfesionController@destroy');
});

Route::prefix('departamento')->group(function () {
    Route::get('/', 'DepartamentoController@index');
    Route::post('/new', 'DepartamentoController@store');// (datos en body)
    Route::get('/{id}', 'DepartamentoController@show');
    Route::patch('/{id}', 'DepartamentoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'DepartamentoController@destroy');
});

Route::prefix('idioma')->group(function () {
    Route::get('/', 'IdiomaController@index');
    Route::post('/new', 'IdiomaController@store');// (datos en body)
    Route::get('/{id}', 'IdiomaController@show');
    Route::patch('/{id}', 'IdiomaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'IdiomaController@destroy');
});

Route::prefix('tipo-usuario')->group(function () {
    Route::get('/', 'TipoUsuarioController@index');
    Route::post('/new', 'TipoUsuarioController@store');// (datos en body)
    Route::get('/{id}', 'TipoUsuarioController@show');
    Route::patch('/{id}', 'TipoUsuarioController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'TipoUsuarioController@destroy');
});

Route::prefix('tipo-sangre')->group(function () {
    Route::get('/', 'TipoSangreController@index');
    Route::post('/new', 'TipoSangreController@store');// (datos en body)
    Route::get('/{id}', 'TipoSangreController@show');
    Route::patch('/{id}', 'TipoSangreController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'TipoSangreController@destroy');
});

Route::prefix('vehiculo')->group(function () {
    Route::get('/', 'VehiculoController@index');
    Route::post('/new', 'VehiculoController@store');// (datos en body)
    Route::get('/{id}', 'VehiculoController@show');
    Route::patch('/{id}', 'VehiculoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'VehiculoController@destroy');
    Route::get('/excel/reporte', 'VehiculoController@excelReport');
});

Route::prefix('empresa')->group(function () {
    Route::get('/', 'EmpresaController@index');
    Route::post('/new', 'EmpresaController@store');// (datos en body)
    Route::get('/{id}', 'EmpresaController@show');
    Route::patch('/{id}', 'EmpresaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpresaController@destroy');
    Route::get('/excel/reporte', 'EmpresaController@excelReport');
});

Route::prefix('certificado')->group(function () {
    Route::get('/', 'CertificadoController@index');
    Route::post('/new', 'CertificadoController@store');// (datos en body)
    Route::get('/{id}', 'CertificadoController@show');
    Route::patch('/{id}', 'CertificadoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'CertificadoController@destroy');
    Route::get('/excel/reporte', 'CertificadoController@excelReport');
});

Route::prefix('extintor-cliente')->group(function () {
    Route::get('/', 'ExtintorClienteController@index');
    Route::post('/new', 'ExtintorClienteController@store');// (datos en body)
    Route::get('/{id}', 'ExtintorClienteController@show');
    Route::patch('/{id}', 'ExtintorClienteController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'ExtintorClienteController@destroy');
    Route::get('/excel/reporte', 'ExtintorClienteController@excelReport');
});

Route::prefix('ciudad')->group(function () {
    Route::get('/', 'CiudadController@index');
    Route::post('/new', 'CiudadController@store');// (datos en body)
    Route::get('/{id}', 'CiudadController@show');
    Route::patch('/{id}', 'CiudadController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'CiudadController@destroy');
});

Route::prefix('rango')->group(function () {
    Route::get('/', 'RangoController@index');
    Route::post('/new', 'RangoController@store');// (datos en body)
    Route::get('/{id}', 'RangoController@show');
    Route::patch('/{id}', 'RangoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'RangoController@destroy');
    Route::get('/excel/reporte', 'RangoController@excelReport');
});

Route::prefix('categoria-licencia')->group(function () {
    Route::get('/', 'CategoriaLicenciaController@index');
    Route::post('/new', 'CategoriaLicenciaController@store');// (datos en body)
    Route::get('/{id}', 'CategoriaLicenciaController@show');
    Route::patch('/{id}', 'CategoriaLicenciaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'CategoriaLicenciaController@destroy');
});

Route::prefix('tipo-informante')->group(function () {
    Route::get('/', 'TipoInformanteController@index');
    Route::post('/new', 'TipoInformanteController@store');// (datos en body)
    Route::get('/{id}', 'TipoInformanteController@show');
    Route::patch('/{id}', 'TipoInformanteController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'TipoInformanteController@destroy');
});

Route::prefix('persona')->group(function () {
    Route::get('/', 'PersonaController@index');
    Route::get('/no-empleado', 'PersonaController@personasNoEmpleadas');
    Route::post('/new', 'PersonaController@store');// (datos en body)
    Route::get('/{id}', 'PersonaController@show');
    Route::patch('/{id}', 'PersonaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'PersonaController@destroy');
    Route::get('/excel/reporte', 'PersonaController@excelReport');
});

Route::prefix('empleado')->group(function () {
    Route::get('/', 'EmpleadoController@index');
    Route::get('/hojas-de-vida', 'EmpleadoController@curriculums');
    Route::get('/inspectores', 'EmpleadoController@inspectores');
    Route::get('/sin-nombramiento', 'EmpleadoController@employeeWithoutAppointment');
    Route::get('/sin-huella', 'EmpleadoController@empleadosSinHuellas');
    Route::get('/acceso-huella-cancelar', 'EmpleadoController@cancelFingerPrint');
    Route::get('/hoja-de-vida/{id}', 'EmpleadoController@curriculumPersonal');
    Route::get('/con-huella/{id}', 'EmpleadoController@showHasFingerPrint');
    Route::get('/permiso-editar/{id}', 'EmpleadoController@EmployeeValidForEdit');
    Route::get('/{id}', 'EmpleadoController@show');
    Route::post('/new', 'EmpleadoController@store');// (datos en body)
    Route::patch('/{id}', 'EmpleadoController@update');// (id escrito en link, y datos en params)
    Route::patch('/acceso/{id}', 'EmpleadoController@updatePermissions');
    Route::delete('/{id}', 'EmpleadoController@destroy');
    Route::get('/excel/reporte', 'EmpleadoController@excelReport');
});

Route::prefix('empleado-licencia')->group(function () {
    Route::get('/', 'EmpleadoLicenciaController@index');
    Route::post('/new', 'EmpleadoLicenciaController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoLicenciaController@show');
    Route::patch('/{id}', 'EmpleadoLicenciaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoLicenciaController@destroy');
});

Route::prefix('empleado-libreta')->group(function () {
    Route::get('/', 'EmpleadoLibretaController@index');
    Route::post('/new', 'EmpleadoLibretaController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoLibretaController@show');
    Route::patch('/{id}', 'EmpleadoLibretaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoLibretaController@destroy');
});

Route::prefix('radio')->group(function () {
    Route::get('/', 'RadioController@index');
    Route::post('/new', 'RadioController@store');// (datos en body)
    Route::get('/{id}', 'RadioController@show');
    Route::patch('/{id}', 'RadioController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'RadioController@destroy');
    Route::get('/excel/reporte', 'RadioController@excelReport');
});

Route::prefix('log')->group(function () {
    Route::get('/', 'LogController@index');
    Route::get('/excel/reporte', 'LogController@excelReport');
});

Route::prefix('empleado-experiencia')->group(function () {
    Route::get('/', 'EmpleadoExperienciaController@index');
    Route::post('/new', 'EmpleadoExperienciaController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoExperienciaController@show');
    Route::get('/empleado/{idEmpleado}', 'EmpleadoExperienciaController@showForEmployee');
    Route::patch('/{id}', 'EmpleadoExperienciaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoExperienciaController@destroy');
    Route::get('/excel/reporte', 'EmpleadoExperienciaController@excelReport');
});

Route::prefix('empleado-educacion')->group(function () {
    Route::get('/', 'EmpleadoEducacionController@index');
    Route::post('/new', 'EmpleadoEducacionController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoEducacionController@show');
    Route::get('/empleado/{idEmpleado}', 'EmpleadoEducacionController@showForEmployee');
    Route::patch('/{id}', 'EmpleadoEducacionController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoEducacionController@destroy');
    Route::get('/excel/reporte', 'EmpleadoEducacionController@excelReport');
});

Route::prefix('empleado-condecoracion')->group(function () {
    Route::get('/', 'EmpleadoCondecoracionController@index');
    Route::post('/new', 'EmpleadoCondecoracionController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoCondecoracionController@show');
    Route::patch('/{id}', 'EmpleadoCondecoracionController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoCondecoracionController@destroy');
    Route::get('/excel/reporte', 'EmpleadoCondecoracionController@excelReport');
});

Route::prefix('empleado-curso-bomberil')->group(function () {
    Route::get('/', 'EmpleadoCursoBomberilController@index');
    Route::post('/new', 'EmpleadoCursoBomberilController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoCursoBomberilController@show');
    Route::get('/empleado/{idEmpleado}', 'EmpleadoCursoBomberilController@showForEmployee');
    Route::patch('/{id}', 'EmpleadoCursoBomberilController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoCursoBomberilController@destroy');
    Route::get('/excel/reporte', 'EmpleadoCursoBomberilController@excelReport');
});

Route::prefix('empleado-capacitacion')->group(function () {
    Route::get('/', 'EmpleadoCapacitacionController@index');
    Route::post('/new', 'EmpleadoCapacitacionController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoCapacitacionController@show');
    Route::get('/empleado/{idEmpleado}', 'EmpleadoCapacitacionController@showForEmployee');
    Route::patch('/{id}', 'EmpleadoCapacitacionController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoCapacitacionController@destroy');
    Route::get('/excel/reporte', 'EmpleadoCapacitacionController@excelReport');
});

Route::prefix('empleado-nombramiento')->group(function () {
    Route::get('/', 'EmpleadoNombramientoController@index');
    Route::post('/new', 'EmpleadoNombramientoController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoNombramientoController@show');
    Route::patch('/{id}', 'EmpleadoNombramientoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoNombramientoController@destroy');
    Route::get('/excel/reporte', 'EmpleadoNombramientoController@excelReport');
});

Route::prefix('empleado-sancion')->group(function () {
    Route::get('/', 'EmpleadoSancionController@index');
    Route::post('/new', 'EmpleadoSancionController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoSancionController@show');
    Route::patch('/{id}', 'EmpleadoSancionController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoSancionController@destroy');
    Route::get('/excel/reporte', 'EmpleadoSancionController@excelReport');
});

Route::prefix('bitacora')->group(function () {
    Route::get('/', 'BitacoraController@index');
    Route::post('/new', 'BitacoraController@store');// (datos en body)
    Route::post('/reporte', 'BitacoraController@bitacoraPersonal');// (datos en body)
    Route::get('/{id}', 'BitacoraController@show');
    Route::patch('/{id}', 'BitacoraController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'BitacoraController@destroy');
    Route::get('/excel/reporte', 'BitacoraController@excelReport');
});

Route::prefix('bitacora-elemento')->group(function () {
    Route::get('/', 'BitacoraElementoController@index');
    Route::post('/new', 'BitacoraElementoController@store');// (datos en body)
    Route::get('/{id}', 'BitacoraElementoController@show');
    Route::patch('/{id}', 'BitacoraElementoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'BitacoraElementoController@destroy');
});

Route::prefix('huella')->group(function () {
    Route::get('/', 'HuellaController@index');
    Route::post('/new', 'HuellaController@store');// (datos en body)
    Route::get('/{id}', 'HuellaController@show');
    Route::patch('/{id}', 'HuellaController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'HuellaController@destroy');
    Route::delete('/por-empleado/{id}', 'HuellaController@destroyForIdEmploye');
});

Route::prefix('bitacora-tripulante')->group(function () {
    Route::get('/', 'BitacoraTripulanteController@index');
    Route::post('/new', 'BitacoraTripulanteController@store');// (datos en body)
    Route::get('/{id}', 'BitacoraTripulanteController@show');
    Route::patch('/{id}', 'BitacoraTripulanteController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'BitacoraTripulanteController@destroy');
});

Route::prefix('empleado-ascenso')->group(function () {
    Route::get('/', 'EmpleadoAscensoController@index');
    Route::post('/new', 'EmpleadoAscensoController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoAscensoController@show');
    Route::patch('/{id}', 'EmpleadoAscensoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoAscensoController@destroy');
    Route::get('/excel/reporte', 'EmpleadoAscensoController@excelReport');
});

Route::prefix('idioma-empleado')->group(function () {
    Route::get('/', 'IdiomaEmpleadoController@index');
    Route::post('/new', 'IdiomaEmpleadoController@store');// (datos en body)
    Route::get('/{id}', 'IdiomaEmpleadoController@show');
    Route::patch('/{id}', 'IdiomaEmpleadoController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'IdiomaEmpleadoController@destroy');
});

Route::prefix('empleado-informacion-bomberil')->group(function () {
    Route::get('/', 'EmpleadoInformacionBomberilController@index');
    Route::post('/new', 'EmpleadoInformacionBomberilController@store');// (datos en body)
    Route::get('/{id}', 'EmpleadoInformacionBomberilController@show');
    Route::get('/empleado/{idEmpleado}', 'EmpleadoInformacionBomberilController@showForEmployee');
    Route::patch('/{id}', 'EmpleadoInformacionBomberilController@update');// (id escrito en link, y datos en params)
    Route::delete('/{id}', 'EmpleadoInformacionBomberilController@destroy');
    Route::get('/excel/reporte', 'EmpleadoInformacionBomberilController@excelReport');
});

Route::post('/login','Auth\LoginController@login');
Route::post('/login-huella','Auth\LoginController@loginFingerPrint');