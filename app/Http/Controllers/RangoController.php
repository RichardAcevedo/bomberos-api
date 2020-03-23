<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RangoExport;

use App\Models\Rango;
use App\Models\CategoriaRango;

class RangoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rangos = Rango::all();
        foreach ($rangos as $rango) {
            $categoriaRango = CategoriaRango::find($rango->id_categoria_rango);
            $rango->categoria_rango = $categoriaRango;
            unset($rango->id_categoria_rango);
        }
        return $rangos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idCategoriaRango = CategoriaRango::find($request['idCategoriaRango']);
        if ($idCategoriaRango) {
            $rango = new Rango;
            // $rango->id = $rango->id;
            $rango->nombre= $request['nombre'];
            $rango->descripcion= $request['descripcion'];
            $rango->id_categoria_rango= $request['idCategoriaRango'];
            $rango->save();
            return $rango;
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
        $rango = Rango::find($id);
        if ($rango) {
            $categoriaRango = CategoriaRango::find($rango->id_categoria_rango);
            $rango->categoria_rango = $categoriaRango;
            unset($rango->id_categoria_rango);
            return $rango;
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
        $rango = Rango::find($id);
        $idCategoriaRango = $request['idCategoriaRango'];
        $validCategoriaRango = isset($idCategoriaRango) ? (CategoriaRango::find($idCategoriaRango) ? true : false) : true;
        if ($rango && $validCategoriaRango) {
            $rango->id = $rango->id;
            $rango->nombre = isset($request['nombre']) ? $request['nombre'] : $rango->nombre;
            $rango->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $rango->descripcion;
            $rango->id_categoria_rango = isset($request['idCategoriaRango']) ? $request['idCategoriaRango'] : $rango->id_categoria_rango;
            $rango->save();
            return $rango;
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
        $rango = Rango::find($id);
        if ($rango) {
            $rango->delete();
            return $rango;
        }
        return [];
    }

    public function excelReport() {
        return new RangoExport();
    }
}
