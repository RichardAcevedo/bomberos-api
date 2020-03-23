<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogExport;

use App\Models\Log;
use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = DB::table('log')->get();
        foreach ($logs as $log) {
            $log->event = $log->event == "created" ? "Creación" : $log->event;
            $log->event = $log->event == "updated" ? "Actualización" : $log->event;
            $log->event = $log->event == "deleted" ? "Eliminación" : $log->event;
            $log->event = $log->event == "restored" ? "Restauración" : $log->event;
            $log->old_values = json_decode($log->old_values);
            $log->new_values = json_decode($log->new_values);
        }
        return $logs;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $idEmpleado = Empleado::find($request['idEmpleado']);
    //     if ($idEmpleado) {
    //         $log = new Log;
    //         // $log->id = $log->id;
    //         $log->descripcion = $request['descripcion'];
    //         $log->fecha = $request['fecha'];
    //         $log->ip = $request['ip'];
    //         $log->cadena_sql = $request['cadenaSql'];
    //         $log->afectado = $request['afectado'];
    //         $log->id_empleado = $request['idEmpleado'];
    //         $log->save();
    //         return $log;
    //     }
    //     return [];
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     $log = Log::find($id);
    //     if ($log) {
    //         $empleado = Empleado::find($log->id_empleado);
    //         $persona = Persona::find($empleado->id_persona);
    //         $empleado->persona = $persona;
    //         $log->empleado = $empleado;
    //         unset($empleado->id_persona);
    //         unset($log->id_empleado);
    //         return $empleado;
    //     }
    //     return response('Registro no encontrado', 400)->header('Content-Type', 'text/plain');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     $log = Log::find($id);
    //     $idEmpleado = $request['idEmpleado'];
    //     $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
    //     if ($log && $validEmpleado) {
    //         $log->id = $log->id;
    //         $log->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $log->descripcion;
    //         $log->fecha = isset($request['fecha']) ? $request['fecha'] : $log->fecha;
    //         $log->ip = isset($request['ip']) ? $request['ip'] : $log->ip;
    //         $log->cadena_sql = isset($request['cadenaSql']) ? $request['cadenaSql'] : $log->cadena_sql;
    //         $log->afectado = isset($request['afectado']) ? $request['afectado'] : $log->afectado;
    //         $log->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $log->id_empleado;
    //         $log->save();
    //         return $log;
    //     }
    //     return [];
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $log = Log::find($id);
    //     if ($log) {
    //         $log->delete();
    //         return $log;
    //     }
    //     return [];
    // }

    public function excelReport() {
        return new LogExport();
    }
}
