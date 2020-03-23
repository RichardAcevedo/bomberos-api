<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BitacoraExport;

use App\Models\Bitacora;
use App\Models\Evento;
use App\Models\Emergency;
use App\Models\BitacoraAsunto;
use App\Models\Empleado;
use App\Models\Asunto;
use App\Models\Persona;
use App\Models\VehiculoElemento;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bitacoras = Bitacora::all();
        foreach ($bitacoras as $bitacora) {
            $bitacora->atributos = json_decode($bitacora->atributos);
            $asunto = Asunto::find($bitacora->id_asunto);
            $usuarioSesion = Empleado::find($bitacora->id_usuario_sesion);
            $persona = Persona::find($usuarioSesion->id_persona);
            $bitacora->asunto = $asunto;
            $usuarioSesion->persona = $persona;
            $bitacora->usuario_sesion = $usuarioSesion;
            unset($bitacora->id_asunto);
            unset($bitacora->id_usuario_sesion);
            unset($usuarioSesion->id_persona);
        }
        return $bitacoras;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idUsuarioSesion = Empleado::find($request['idUsuarioSesion']);
        $idAsunto = Asunto::find($request['idAsunto']);
        if ($idUsuarioSesion && $idAsunto) {

            $bitacora = new Bitacora;
            // $bitacora->id = $bitacora->id;
            $bitacora->fecha = $request['fecha'];
            $bitacora->hora = $request['hora'];
            $bitacora->descripcion = $request['descripcion'];
            $bitacora->id_usuario_sesion = $request['idUsuarioSesion'];
            $bitacora->id_asunto = $request['idAsunto'];
            $asunto = Asunto::find($bitacora->id_asunto);
            if ($asunto->nombre == 'Entrada de máquina' || $asunto->nombre == 'Salida de máquina') {
                $idVehiculo = $request['atributos.vehicle.id'];
                $requestElementos = $request['atributos.newElements'];
                $elementos = VehiculoElemento::where('vehiculo_elemento.id_vehiculo', '=', $idVehiculo)
                                        ->get();
                foreach ($elementos as $elemento) {
                    $elemento->delete();
                }
                foreach ($requestElementos as $requestElemento) {
                    $vehiculoElemento = new VehiculoElemento;
                    $vehiculoElemento->id_elemento = $requestElemento['id'];
                    $vehiculoElemento->id_vehiculo = $idVehiculo;
                    $vehiculoElemento->save();
                }
            }
            if ($request['fromJava']) {
                $bitacora->atributos = $request['atributos'];
            } else {
                $bitacora->atributos = json_encode($request['atributos']);
            }
            $bitacora->save();

            if ($request['idAsunto'] == 1) {

                $user = Bitacora::all();
                $emergency = new Emergency;
                $emergency->idMinuta = $user->last()->id;

                $evento = Evento::find($request['atributos.event.id']);
                
                $emergency->tipoEmergency = $evento->nombre;
                $emergency->estado = $request['atributos.state'];
                $emergency->descripcion = $request['descripcion'];
                $emergency->save();
            }

            return $bitacora;
        }
        return [];
    }

    public function bitacoraPersonal(Request $request) {
        $asunto = Asunto::find($request['idAsunto']);
        $bitacoras = Bitacora::where('bitacora.id_asunto', '=', $asunto->id)
                                ->get();
        foreach ($bitacoras as $bitacora) {
            $bitacora->atributos = json_decode($bitacora->atributos);
            $usuarioSesion = Empleado::find($bitacora->id_usuario_sesion);
            $persona = Persona::find($usuarioSesion->id_persona);
            $bitacora->asunto = $asunto; // esta definido arriba
            $usuarioSesion->persona = $persona;
            $bitacora->usuario_sesion = $usuarioSesion;
            unset($bitacora->id_asunto);
            unset($bitacora->id_usuario_sesion);
            unset($usuarioSesion->id_persona);
        }
        if ($asunto->nombre == 'Entrada de personal' || $asunto->nombre == 'Salida de personal') {
            $bitacorasSeleccionadas = [];
            foreach ($bitacoras as $bitacora) {
                if ($bitacora->atributos->employee->id == $request['idEmpleado']) {
                    array_push($bitacorasSeleccionadas, $bitacora);
                }
            }
            return $bitacorasSeleccionadas;
        } else if ($asunto->nombre == 'Relevo') {
            $bitacorasSeleccionadas = [];
            foreach ($bitacoras as $bitacora) {
                if ($bitacora->atributos->employeeDelivery->id == $request['idEmpleado'] || $bitacora->atributos->employeeReceives->id == $request['idEmpleado']) {
                    array_push($bitacorasSeleccionadas, $bitacora);
                }
            }
            return $bitacorasSeleccionadas;
        } else if ($asunto->nombre == 'Entrada de máquina' || $asunto->nombre == 'Salida de máquina' || $asunto->nombre == 'Novedades en máquinas') {
            $bitacorasSeleccionadas = [];
            foreach ($bitacoras as $bitacora) {
                if ($bitacora->atributos->vehicle->id == $request['idVehiculo']) {
                    array_push($bitacorasSeleccionadas, $bitacora);
                }
            }
            return $bitacorasSeleccionadas;
        }
        return $bitacoras;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bitacora = Bitacora::find($id);
        if ($bitacora) {
            $bitacora->atributos = json_decode($bitacora->atributos);
            $asunto = Asunto::find($bitacora->id_asunto);
            $usuarioSesion = Empleado::find($bitacora->id_usuario_sesion);
            $persona = Persona::find($usuarioSesion->id_persona);
            $usuarioSesion->persona = $persona;
            $bitacora->asunto = $asunto;
            $bitacora->usuario_sesion = $usuarioSesion;
            unset($bitacora->id_asunto);
            unset($bitacora->id_usuario_sesion);
            unset($usuarioSesion->id_persona);
            return $bitacora;
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
        $bitacora = Bitacora::find($id);
        $idUsuarioSesion = $request['idUsuarioSesion'];
        $idAsunto = $request['idAsunto'];
        $validEmpleado = isset($idUsuarioSesion) ? (Empleado::find($idUsuarioSesion) ? true : false) : true;
        $validAsunto = isset($idAsunto) ? (Asunto::find($idAsunto) ? true : false) : true;
        if ($bitacora && $validEmpleado && $validAsunto) {
            $bitacora->id = $bitacora->id;
            $bitacora->fecha = isset($request['fecha']) ? $request['fecha'] : $bitacora->fecha;
            $bitacora->hora = isset($request['hora']) ? $request['hora'] : $bitacora->hora;
            $bitacora->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $bitacora->descripcion;
            $asunto = Asunto::find($idAsunto);
            if ($request['atributos'] && ($asunto->nombre == 'Entrada de máquina' || $asunto->nombre == 'Salida de máquina')) {
                $idVehiculo = $request['atributos.vehicle.id'];
                $requestElementos = $request['atributos.newElements'];
                $elementos = VehiculoElemento::where('vehiculo_elemento.id_vehiculo', '=', $idVehiculo)
                                        ->get();
                foreach ($elementos as $elemento) {
                    $elemento->delete();
                }
                foreach ($requestElementos as $requestElemento) {
                    $vehiculoElemento = new VehiculoElemento;
                    $vehiculoElemento->id_elemento = $requestElemento['id'];
                    $vehiculoElemento->id_vehiculo = $idVehiculo;
                    $vehiculoElemento->save();
                }
                $bitacora->atributos = json_encode($request['atributos']);
            } else {
                $bitacora->atributos = isset($request['atributos']) ? $request['atributos'] : $bitacora->atributos;
            }
            $bitacora->id_usuario_sesion = isset($request['idUsuarioSesion']) ? $request['idUsuarioSesion'] : $bitacora->id_usuario_sesion;
            $bitacora->id_asunto = isset($request['idAsunto']) ? $request['idAsunto'] : $bitacora->id_asunto;
            $bitacora->save();

            if ($request['idAsunto'] == 1) {

                $user = Bitacora::all();
                $emergency = new Emergency;
                $emergency->idMinuta = $id;

                $evento = Evento::find($request['atributos.event.id']);
                
                $emergency->tipoEmergency = $evento->nombre;
                $emergency->estado = $request['atributos.state'];
                $emergency->descripcion = $request['descripcion'];
                $emergency->save();
            }


            return $bitacora;
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
        $bitacora = Bitacora::find($id);
        if ($bitacora) {
            $bitacora->delete();
            return $bitacora;
        }
        return [];
    }

    public function excelReport() {
        return new BitacoraExport();
    }
}
