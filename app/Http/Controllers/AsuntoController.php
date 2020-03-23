<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsuntoExport;

use App\Models\Asunto;

class AsuntoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Asunto::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $asunto = new Asunto;
        // $asunto->id = $asunto->id;
        $asunto->nombre= $request['nombre'];
        $asunto->save();
        return $asunto;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $asunto = Asunto::find($id);
        return isset($asunto) ? $asunto : [];
    }

    public function showForName($name)
    {
        $asunto = Asunto::where('asunto.nombre', "=", $name)
                        ->first();
        return isset($asunto) ? $asunto : [];
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
        $asunto = Asunto::find($id);
        if ($asunto) {
            $asunto->id = $asunto->id;
            $asunto->nombre = isset($request['nombre']) ? $request['nombre'] : $asunto->nombre;
            $asunto->save();
            return $asunto;
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
        $asunto = Asunto::find($id);
        if ($asunto) {
            $asunto->delete();
            return $asunto;
        }
        return [];
    }

    public function excelReport() {
        return new AsuntoExport();
    }
}
