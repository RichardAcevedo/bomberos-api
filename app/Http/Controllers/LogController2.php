<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogExport;

use App\Models\Log2;
use App\Models\Empleado;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class LogController2 extends Controller
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

    public function excelReport() {
        return new LogExport();
    }
}
