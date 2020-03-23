<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoSangre;

class TipoSangreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TipoSangre::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipoSangre = new TipoSangre;
        // $tipoSangre->id = $tipoSangre->id;
        $tipoSangre->nombre= $request['nombre'];
        $tipoSangre->save();
        return $tipoSangre;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipoSangre = TipoSangre::find($id);
        return isset($tipoSangre) ? $tipoSangre : [];
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
        $tipoSangre = TipoSangre::find($id);
        if ($tipoSangre) {
            $tipoSangre->id = $tipoSangre->id;
            $tipoSangre->nombre = isset($request['nombre']) ? $request['nombre'] : $tipoSangre->nombre;
            $tipoSangre->save();
            return $tipoSangre;
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
        $tipoSangre = TipoSangre::find($id);
        if ($tipoSangre) {
            $tipoSangre->delete();
            return $tipoSangre;
        }
        return [];
    }
}
