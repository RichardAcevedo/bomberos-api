<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TipoEmpresaExport;

use App\Models\TipoEmpresa;

class TipoEmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoEmpresa::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoEmpresa = new TipoEmpresa;
        // $tipoEmpresa->id = $tipoEmpresa->id;
        $tipoEmpresa->nombre= $request['nombre'];
        $tipoEmpresa->save();
        return $tipoEmpresa;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoEmpresa = TipoEmpresa::find($id);
        return isset($tipoEmpresa) ? $tipoEmpresa : [];
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
        $tipoEmpresa = TipoEmpresa::find($id);
        if ($tipoEmpresa) {
            $tipoEmpresa->id = $tipoEmpresa->id;
            $tipoEmpresa->nombre = isset($request['nombre']) ? $request['nombre'] : $tipoEmpresa->nombre;
            $tipoEmpresa->save();
            return $tipoEmpresa;
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
        $tipoEmpresa = TipoEmpresa::find($id);
        if ($tipoEmpresa) {
            $tipoEmpresa->delete();
            return $tipoEmpresa;
        }
        return [];
    }

    public function excelReport() {
        return new TipoEmpresaExport();
    }
}
