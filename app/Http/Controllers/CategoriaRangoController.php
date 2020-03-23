<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriaRangoExport;

use App\Models\CategoriaRango;

class CategoriaRangoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoriaRango::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoriaRango = new CategoriaRango;
        // $categoriaRango->id = $categoriaRango->id;
        $categoriaRango->nombre= $request['nombre'];
        $categoriaRango->save();
        return $categoriaRango;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoriaRango = CategoriaRango::find($id);
        return isset($categoriaRango) ? $categoriaRango : [];
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
        $categoriaRango = CategoriaRango::find($id);
        if ($categoriaRango) {
            $categoriaRango->id = $categoriaRango->id;
            $categoriaRango->nombre = isset($request['nombre']) ? $request['nombre'] : $categoriaRango->nombre;
            $categoriaRango->save();
            return $categoriaRango;
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
        $categoriaRango = CategoriaRango::find($id);
        if ($categoriaRango) {
            $categoriaRango->delete();
            return $categoriaRango;
        }
        return [];
    }

    public function excelReport() {
        return new CategoriaRangoExport();
    }
}
