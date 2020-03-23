<?php

use Illuminate\Database\Seeder;

class TipoVehiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_vehiculo')->delete();

        $tiposVehiculo =
        [
            ['nombre' => 'AMBULANCIA'],
            ['nombre' => 'RESCATE'],
            ['nombre' => 'APAGAFUEGO ATAQUE INICIAL'],
            ['nombre' => 'APAGAFUEGO TANQUE BOMBA'],
            ['nombre' => 'APOYO LOGISTICO'],
        ];

        foreach ($tiposVehiculo as $tipoVehiculo) {
            DB::table('tipo_vehiculo')->insert($tipoVehiculo);
        }
    }
}
