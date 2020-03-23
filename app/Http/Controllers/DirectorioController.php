<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DirectorioExport;

use App\Models\Directorio;

class DirectorioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Directorio::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $directorio = new Directorio;
        // $directorio->id = $directorio->id;
        $directorio->telefono= $request['telefono'];
        $directorio->direccion= $request['direccion'];
        $directorio->barrio= $request['barrio'];
        $directorio->nombre= $request['nombre'];
        $directorio->zona= $request['zona'];
        $directorio->save();
        return $directorio;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $directorio = Directorio::find($id);
        return isset($directorio) ? $directorio : [];
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
        $directorio = Directorio::find($id);
        if ($directorio) {
            $directorio->id = $directorio->id;
            $directorio->telefono = isset($request['telefono']) ? $request['telefono'] : $directorio->telefono;
            $directorio->direccion = isset($request['direccion']) ? $request['direccion'] : $directorio->direccion;
            $directorio->barrio = isset($request['barrio']) ? $request['barrio'] : $directorio->barrio;
            $directorio->nombre = isset($request['nombre']) ? $request['nombre'] : $directorio->nombre;
            $directorio->zona = isset($request['zona']) ? $request['zona'] : $directorio->zona;
            $directorio->save();
            return $directorio;
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
        $directorio = Directorio::find($id);
        if ($directorio) {
            $directorio->delete();
            return $directorio;
        }
        return [];
    }

    public function excelReport() {
        return new DirectorioExport();
    }
}
