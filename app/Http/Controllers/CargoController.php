<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CargoExport;

use App\Models\Cargo;
use App\Models\EmpleadoNombramiento;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Cargo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cargo = new Cargo;
        // $cargo->id = $cargo->id;
        $cargo->nombre= $request['nombre'];
        $cargo->save();
        return $cargo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $cargo = Cargo::find($id);
        return isset($cargo) ? $cargo : [];
    }

    public function getAvailables($id) {
        $nombramientos = EmpleadoNombramiento::where('empleado_nombramiento.id_empleado', '=', $id)->get();

        if (count($nombramientos) > 0) {
            $cargosInvalidos = Cargo::leftJoin('empleado_nombramiento', function($q) use ($id)
            {
                $q->on('cargo.id', '=', 'empleado_nombramiento.id_cargo')
                    ->where('empleado_nombramiento.id_empleado', '=', $id);
            })
            // ->where('empleado_nombramiento.id', '=', null)
            ->orWhere('empleado_nombramiento.activo', '<>', 'No')
            ->select('cargo.*')
            ->get();

            $cargos = Cargo::all();
            $idsInvalidos = [];
            $resultado = [];
            
            foreach ($cargosInvalidos as $cargoInvalido) {
                array_push($idsInvalidos, $cargoInvalido->id);
            }

            foreach ($cargos as $cargo) {
                if (!in_array($cargo->id, $idsInvalidos, true)) {
                    array_push($resultado, $cargo);
                }
            }
            return $resultado;
        }
        return Cargo::all();
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
        $cargo = Cargo::find($id);
        if ($cargo) {
            $cargo->id = $cargo->id;
            $cargo->nombre = isset($request['nombre']) ? $request['nombre'] : $cargo->nombre;
            $cargo->save();
            return $cargo;
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
        $cargo = Cargo::find($id);
        if ($cargo) {
            $cargo->delete();
            return $cargo;
        }
        return [];
    }

    public function excelReport() {
        return new CargoExport();
    }
}
