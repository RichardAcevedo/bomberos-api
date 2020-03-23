<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TipoCondecoracionExport;

use App\Models\TipoCondecoracion;

class TipoCondecoracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoCondecoracion::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoCondecoracion = new TipoCondecoracion;
        // $tipoCondecoracion->id = $tipoCondecoracion->id;
        $tipoCondecoracion->nombre= $request['nombre'];
        $tipoCondecoracion->save();
        return $tipoCondecoracion;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoCondecoracion = TipoCondecoracion::find($id);
        return isset($tipoCondecoracion) ? $tipoCondecoracion : [];
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
        $tipoCondecoracion = TipoCondecoracion::find($id);
        if ($tipoCondecoracion) {
            $tipoCondecoracion->id = $tipoCondecoracion->id;
            $tipoCondecoracion->nombre = isset($request['nombre']) ? $request['nombre'] : $tipoCondecoracion->nombre;
            $tipoCondecoracion->save();
            return $tipoCondecoracion;
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
        $tipoCondecoracion = TipoCondecoracion::find($id);
        if ($tipoCondecoracion) {
            $tipoCondecoracion->delete();
            return $tipoCondecoracion;
        }
        return [];
    }

    public function excelReport() {
        return new TipoCondecoracionExport();
    }
}
