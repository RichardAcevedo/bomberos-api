<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Huella;
use App\Models\Empleado;

class HuellaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Huella::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idEmpleado = Empleado::find($request['idEmpleado']);
        if ($idEmpleado) {
            $huella = new Huella;
            // $huella->id = $huella->id;
            $huella->huella = $request['huella'];
            $huella->id_empleado = $request['idEmpleado'];
            $huella->save();
            return $huella;
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
        $huella = Huella::find($id);
        return isset($huella) ? $huella : [];
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
        $huella = Huella::find($id);
        $idEmpleado = $request['idEmpleado'];
        $validEmpleado = isset($idEmpleado) ? (Empleado::find($idEmpleado) ? true : false) : true;
        if ($huella && $validEmpleado) {
            $huella->id = $huella->id;
            $huella->huella = isset($request['huella']) ? $request['huella'] : $huella->huella;
            $huella->id_empleado = isset($request['idEmpleado']) ? $request['idEmpleado'] : $huella->id_empleado;
            $huella->save();
            return $huella;
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
        $huella = Huella::find($id);
        if ($huella) {
            $huella->delete();
            return $huella;
        }
        return [];
    }

    public function destroyForIdEmploye($idEmpleado)
    {
        $huella = Huella::where('huella.id_empleado', '=', $idEmpleado)->first();
        if ($huella) {
            $huella->delete();
            return $huella;
        }
        return [];
    }
}
