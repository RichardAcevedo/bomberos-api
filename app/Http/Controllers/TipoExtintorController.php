<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TipoExtintorExport;

use App\Models\TipoExtintor;

class TipoExtintorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoExtintor::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoExtintor = new TipoExtintor;
        // $tipoExtintor->id = $tipoExtintor->id;
        $tipoExtintor->nombre= $request['nombre'];
        $tipoExtintor->unidad= $request['unidad'];
        $tipoExtintor->cantidad= $request['cantidad'];
        $tipoExtintor->save();
        return $tipoExtintor;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoExtintor = TipoExtintor::find($id);
        return isset($tipoExtintor) ? $tipoExtintor : [];
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
        $tipoExtintor = TipoExtintor::find($id);
        if ($tipoExtintor) {
            $tipoExtintor->id = $tipoExtintor->id;
            $tipoExtintor->nombre = isset($request['nombre']) ? $request['nombre'] : $tipoExtintor->nombre;
            $tipoExtintor->unidad = isset($request['unidad']) ? $request['unidad'] : $tipoExtintor->unidad;
            $tipoExtintor->cantidad = isset($request['cantidad']) ? $request['cantidad'] : $tipoExtintor->cantidad;
            $tipoExtintor->save();
            return $tipoExtintor;
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
        $tipoExtintor = TipoExtintor::find($id);
        if ($tipoExtintor) {
            $tipoExtintor->delete();
            return $tipoExtintor;
        }
        return [];
    }

    public function excelReport() {
        return new TipoExtintorExport();
    }
}
