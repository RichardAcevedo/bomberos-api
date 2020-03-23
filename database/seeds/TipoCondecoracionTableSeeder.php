<?php

use Illuminate\Database\Seeder;

class TipoCondecoracionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_condecoracion')->delete();

        $tiposCondecoracion =
        [
            ['nombre' => 'Tiempo de servicio cinco (05) años'],
            ['nombre' => 'Tiempo de servicio diez (10) años'],
            ['nombre' => 'Tiempo de servicio quince (15) años'],
            ['nombre' => 'Tiempo de servicio veinte (20) años'],
            ['nombre' => 'Tiempo de servicio veinticinco (25) años'],
        ];

        foreach ($tiposCondecoracion as $tipoCondecoracion) {
            DB::table('tipo_condecoracion')->insert($tipoCondecoracion);
        }
    }
}
