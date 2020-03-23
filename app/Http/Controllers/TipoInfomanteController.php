<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoInformante;

class TipoInformanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoInformante::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoInformante = new TipoInformante;
        $tipoInformante->nombre = $request['nombre'];
        $tipoInformante->save();
        return $tipoInformante;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoInformante = TipoInformante::find($id);
        return isset($tipoInformante) ? $tipoInformante : [];
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
        $tipoInformante = TipoInformante::find($id);
        if ($tipoInformante) {
            $tipoInformante->id = $tipoInformante->id;
            $tipoInformante->nombre = isset($request['nombre']) ? $request['nombre'] : $tipoInformante->nombre;
            $tipoInformante->save();
            return $tipoInformante;
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
        $tipoInformante = TipoInformante::find($id);
        if ($tipoInformante) {
            $tipoInformante->delete();
            return $tipoInformante;
        }
        return [];
    }
}
