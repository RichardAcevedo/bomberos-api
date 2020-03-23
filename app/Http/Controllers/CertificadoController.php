<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CertificadoExport;

use App\Models\Certificado;
use App\Models\Empresa;

class CertificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certificados = Certificado::all();
        foreach ($certificados as $certificado) {
            $empresa = Empresa::find($certificado->id_empresa);
            unset($certificado->id_empresa);
            $certificado->empresa = $empresa;
        }
        return $certificados;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idEmpresa = Empresa::find($request['idEmpresa']);
        if ($idEmpresa) {
            $certificado = new Certificado;
            // $certificado->id = $certificado->id;
            $certificado->tarifa= $request['tarifa'];
            $certificado->fecha= $request['fecha'];
            $certificado->vence= $request['vence'];
            $certificado->id_empresa= $request['idEmpresa'];
            $certificado->save();
            return $certificado;
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
        $certificado = Certificado::find($id);
        if ($certificado) {
            $empresa = Empresa::find($certificado->id_empresa);
            unset($certificado->id_empresa);
            $certificado->empresa = $empresa;
            return $certificado;
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
        $certificado = Certificado::find($id);
        $idEmpresa = $request['idEmpresa'];
        $validEmpresa = isset($idEmpresa) ? (Empresa::find($idEmpresa) ? true : false) : true;
        if ($certificado && $validEmpresa) {
            $certificado->id = $certificado->id;
            $certificado->tarifa = isset($request['tarifa']) ? $request['tarifa'] : $certificado->tarifa;
            $certificado->fecha = isset($request['fecha']) ? $request['fecha'] : $certificado->fecha;
            $certificado->vence = isset($request['vence']) ? $request['vence'] : $certificado->vence;
            $certificado->id_empresa = isset($request['idEmpresa']) ? $request['idEmpresa'] : $certificado->id_empresa;
            $certificado->save();
            return $certificado;
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
        $certificado = Certificado::find($id);
        if ($certificado) {
            $certificado->delete();
            return $certificado;
        }
        return [];
    }

    public function excelReport() {
        return new CertificadoExport();
    }
}
