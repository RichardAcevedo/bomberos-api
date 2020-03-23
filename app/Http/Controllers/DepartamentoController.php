<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Departamento::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departamento = new Departamento;
        // $departamento->id = $departamento->id;
        $departamento->abreviado= $request['abreviado'];
        $departamento->nombre= $request['nombre'];
        $departamento->save();
        return $departamento;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $departamento = Departamento::find($id);
        return isset($departamento) ? $departamento : [];
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
        $departamento = Departamento::find($id);
        if ($departamento) {
            $departamento->id = $departamento->id;
            $departamento->abreviado = isset($request['abreviado']) ? $request['abreviado'] : $departamento->abreviado;
            $departamento->nombre = isset($request['nombre']) ? $request['nombre'] : $departamento->nombre;
            $departamento->save();
            return $departamento;
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
        $departamento = Departamento::find($id);
        if ($departamento) {
            $departamento->delete();
            return $departamento;
        }
        return [];
    }
}
