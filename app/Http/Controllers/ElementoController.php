<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ElementoExport;

use App\Models\Elemento;

class ElementoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Elemento::all();
    }

    public function getElementsAlone()
    {
        $elementos = Elemento::leftJoin('vehiculo_elemento', 'elemento.id', '=', 'vehiculo_elemento.id_elemento')
                                ->where('vehiculo_elemento.id_elemento', '=', null)
                                ->select('elemento.*')
                                ->get();
        return $elementos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $elemento = new Elemento;
        // $elemento->id = $elemento->id;
        $elemento->codigo_inventario= $request['codigoInventario'];
        $elemento->nombre= $request['nombre'];
        $elemento->descripcion= $request['descripcion'];
        $elemento->save();
        return $elemento;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elemento = Elemento::find($id);
        return isset($elemento) ? $elemento : [];
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
        $elemento = Elemento::find($id);
        if ($elemento) {
            $elemento->id = $elemento->id;
            $elemento->codigo_inventario = isset($request['codigoInventario']) ? $request['codigoInventario'] : $elemento->codigo_inventario;
            $elemento->nombre = isset($request['nombre']) ? $request['nombre'] : $elemento->nombre;
            $elemento->descripcion = isset($request['descripcion']) ? $request['descripcion'] : $elemento->descripcion;
            $elemento->save();
            return $elemento;
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
        $elemento = Elemento::find($id);
        if ($elemento) {
            $elemento->delete();
            return $elemento;
        }
        return [];
    }

    public function excelReport() {
        return new ElementoExport();
    }
}
