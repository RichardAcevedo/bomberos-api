<?php

use Illuminate\Database\Seeder;

class CategoriaLicenciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_licencia')->delete();

        $categoriasLicencia =
        [
            ['nombre' => 'A1', 'clase_vehiculo' => 'Motocicletas con motor de hasta 125 cc', 'servicio' => 'Particular'],
            ['nombre' => 'A2', 'clase_vehiculo' => 'Motocicletas, motociclos, mototriciclos con motor mayor a 125 cc', 'servicio' => 'Particular'],
            ['nombre' => 'B1', 'clase_vehiculo' => 'Automóviles, motocarros, cuatrimotos, camperos, camionetas y microbuses', 'servicio' => 'Particular'],
            ['nombre' => 'B2', 'clase_vehiculo' => 'Camiones rígidos, busetas y buses', 'servicio' => 'Particular'],
            ['nombre' => 'B3', 'clase_vehiculo' => 'Vehículos articulados', 'servicio' => 'Particular'],
            ['nombre' => 'C1', 'clase_vehiculo' => 'Automóviles, camperos, camionetas y microbuses', 'servicio' => 'Transporte publico'],
            ['nombre' => 'C2', 'clase_vehiculo' => 'Camiones rígidos, busetas y buses', 'servicio' => 'Transporte publico'],
            ['nombre' => 'C3', 'clase_vehiculo' => 'Vehículos articulados', 'servicio' => 'Transporte publico'],

        ];

        foreach ($categoriasLicencia as $categoriaLicencia) {
            DB::table('categoria_licencia')->insert($categoriaLicencia);
        }
    }
}
