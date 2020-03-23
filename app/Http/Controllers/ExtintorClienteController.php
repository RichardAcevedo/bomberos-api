<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExtintorClienteExport;

use App\Models\ExtintorCliente;
use App\Models\TipoExtintor;
use App\Models\Cliente;
use App\Models\Empresa;

class ExtintorClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $extintores = ExtintorCliente::all();
        foreach ($extintores as $extintor) {
            $cliente = Cliente::find($extintor->id_cliente);
            $extintor->cliente = $cliente;
            unset($extintor->id_cliente);
            $empresa = Empresa::find($extintor->id_empresa);
            $extintor->empresa = $empresa;
            unset($extintor->id_empresa);
            $tipoExtintor = TipoExtintor::find($extintor->id_tipo_extintor);
            $extintor->tipo_extintor = $tipoExtintor;
            unset($extintor->id_tipo_extintor);
        }
        return $extintores;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idTipoExtintor = TipoExtintor::find($request['idTipoExtintor']);
        $idCliente = Cliente::find($request['idCliente']);
        $idEmpresa = Empresa::find($request['idEmpresa']);
        if ($idTipoExtintor && $idCliente && $idEmpresa) {
            $extintorCliente = new ExtintorCliente;
            // $extintorCliente->id = $extintorCliente->id;
            $extintorCliente->fecha= $request['fecha'];
            $extintorCliente->nota_de_servicio= $request['notaDeServicio'];
            $extintorCliente->capacidad= $request['capacidad'];
            $extintorCliente->tarifa= $request['tarifa'];
            $extintorCliente->id_tipo_extintor= $request['idTipoExtintor'];
            $extintorCliente->id_cliente = $request['idCliente'];
            $extintorCliente->id_empresa= $request['idEmpresa'];
            $extintorCliente->save();
            return $extintorCliente;
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
        $extintor = ExtintorCliente::find($id);
        if ($extintor) {
            $cliente = Cliente::find($extintor->id_cliente);
            $extintor->cliente = $cliente;
            unset($extintor->id_cliente);
            $empresa = Empresa::find($extintor->id_empresa);
            $extintor->empresa = $empresa;
            unset($extintor->id_empresa);
            $tipoExtintor = TipoExtintor::find($extintor->id_tipo_extintor);
            $extintor->tipo_extintor = $tipoExtintor;
            unset($extintor->id_tipo_extintor);
            return $extintor;
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
        $extintorCliente = ExtintorCliente::find($id);
        $idTipoExtintor = $request['idTipoExtintor'];
        $idCliente = $request['idCliente'];
        $idEmpresa = $request['idEmpresa'];
        $validTipoExtintor = isset($idTipoExtintor) ? (TipoExtintor::find($idTipoExtintor) ? true : false) : true;
        $validCliente = isset($idCliente) ? (Cliente::find($idCliente) ? true : false) : true;
        $validEmpresa = isset($idEmpresa) ? (Empresa::find($idEmpresa) ? true : false) : true;
        if ($extintorCliente && $validTipoExtintor && $validCliente && $validEmpresa) {
            $extintorCliente->id = $extintorCliente->id;
            $extintorCliente->fecha = isset($request['fecha']) ? $request['fecha'] : $extintorCliente->fecha;
            $extintorCliente->nota_de_servicio = isset($request['notaDeServicio']) ? $request['notaDeServicio'] : $extintorCliente->nota_de_servicio;
            $extintorCliente->capacidad = isset($request['capacidad']) ? $request['capacidad'] : $extintorCliente->capacidad;
            $extintorCliente->tarifa = isset($request['tarifa']) ? $request['tarifa'] : $extintorCliente->tarifa;
            $extintorCliente->id_tipo_extintor = isset($request['idTipoExtintor']) ? $request['idTipoExtintor'] : $extintorCliente->id_tipo_extintor;
            $extintorCliente->id_cliente = isset($request['idCliente']) ? $request['idCliente'] : $extintorCliente->id_cliente;
            $extintorCliente->id_empresa = isset($request['idEmpresa']) ? $request['idEmpresa'] : $extintorCliente->id_empresa;
            $extintorCliente->save();
            return $extintorCliente;
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
        $extintorCliente = ExtintorCliente::find($id);
        if ($extintorCliente) {
            $extintorCliente->delete();
            return $extintorCliente;
        }
        return [];
    }

    public function excelReport() {
        return new ExtintorClienteExport();
    }
}
