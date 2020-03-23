<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdiomaEmpleado;
use App\Models\Idioma;
use App\Models\Empleado;

class IdiomaEmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IdiomaEmpleado::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idIdioma = Idioma::find($request['idIdioma']);
        $idEmpleado = Empleado::find($request['idEmpleado']);
        if ($idIdioma && $idEmpleado) {
            $idiomaEmpleado = new IdiomaEmpleado;
            // $idiomaEmpleado->id = $idiomaEmpleado->id;
            $idiomaEmpleado->id_idioma = $request['idIdioma'];
            $idiomaEmpleado->id_empleado = $request['idEmpleado'];
            $idiomaEmpleado->save();
            return $idiomaEmpleado;
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
        $idiomaEmpleado = IdiomaEmpleado::find($id);
        return isset($idiomaEmpleado) ? $idiomaEmpleado : [];
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
        $idiomaEmpleado = IdiomaEmpleado::find($id);
        $idIdioma = $request['idIdioma'];
        $idEmpleado = $request['idEmpleado'];
        $validIdioma = isset($idIdioma) ? (Idioma::find($idIdioma) ? true : false) : true;
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($idiomaEmpleado && $validIdioma && $validEmpleado) {
            $idiomaEmpleado->id = $idiomaEmpleado->id;
            $idiomaEmpleado->id_idioma = isset($request['idIdioma']) ? $request['idIdioma'] : $idiomaEmpleado->id_idioma;
            $idiomaEmpleado->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $idiomaEmpleado->id_empleado;
            $idiomaEmpleado->save();
            return $idiomaEmpleado;
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
        $idiomaEmpleado = IdiomaEmpleado::find($id);
        if ($idiomaEmpleado) {
            $idiomaEmpleado->delete();
            return $idiomaEmpleado;
        }
        return [];
    }
}
