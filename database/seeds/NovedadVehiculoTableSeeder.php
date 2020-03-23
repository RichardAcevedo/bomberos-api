<?php

use Illuminate\Database\Seeder;

class NovedadVehiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('novedad_vehiculo')->delete();

        $novedades =
        [
            ['nombre' => 'Tanqueo de gasolina'],
            ['nombre' => 'Cambio de aceite'],
            ['nombre' => 'Daño desconcido'],
            ['nombre' => 'Golpe'],
            ['nombre' => 'Accidente'],
            ['nombre' => 'Alineación y balanceo'],
            ['nombre' => 'Batería'],
            ['nombre' => 'Frenos'],
            ['nombre' => 'Llantas'],
        ];

        foreach ($novedades as $novedad) {
            DB::table('novedad_vehiculo')->insert($novedad);
        }
    } 
}
