<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClienteExport;

use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cliente::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente;
        // $cliente->id = $cliente->id;
        $cliente->nombre= $request['nombre'];
        $cliente->documento= $request['documento'];
        $cliente->direccion= $request['direccion'];
        $cliente->telefono= $request['telefono'];
        $cliente->fecha= $request['fecha'];
        $cliente->save();
        return $cliente;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);
        return isset($cliente) ? $cliente : [];
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
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->id = $cliente->id;
            $cliente->nombre = isset($request['nombre']) ? $request['nombre'] : $cliente->nombre;
            $cliente->documento = isset($request['documento']) ? $request['documento'] : $cliente->documento;
            $cliente->direccion = isset($request['direccion']) ? $request['direccion'] : $cliente->direccion;
            $cliente->telefono = isset($request['telefono']) ? $request['telefono'] : $cliente->telefono;
            $cliente->fecha = isset($request['fecha']) ? $request['fecha'] : $cliente->fecha;
            $cliente->save();
            return $cliente;
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
        $cliente = Cliente::find($id);
        if ($cliente) {
            $cliente->delete();
            return $cliente;
        }
        return [];
    }

    public function excelReport() {
        return new ClienteExport();
    }
}
