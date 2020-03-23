<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idioma;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Idioma::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idioma = new Idioma;
        // $idioma->id = $idioma->id;
        $idioma->nombre= $request['nombre'];
        $idioma->save();
        return $idioma;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idioma = Idioma::find($id);
        return isset($idioma) ? $idioma : [];
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
        $idioma = Idioma::find($id);
        if ($idioma) {
            $idioma->id = $idioma->id;
            $idioma->nombre = isset($request['nombre']) ? $request['nombre'] : $idioma->nombre;
            $idioma->save();
            return $idioma;
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
        $idioma = Idioma::find($id);
        if ($idioma) {
            $idioma->delete();
            return $idioma;
        }
        return [];
    }
}
