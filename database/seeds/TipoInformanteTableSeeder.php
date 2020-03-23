<?php

use Illuminate\Database\Seeder;

class TipoInformanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_informante')->delete();

        $tiposInformante =
        [
            ['nombre' => 'Persona'],
            ['nombre' => 'Policia'],
            ['nombre' => 'Defensa civil'],
            ['nombre' => 'Cuerpo de Bomberos'],
            ['nombre' => 'Otra'],
        ];

        foreach ($tiposInformante as $tipoInformante) {
            DB::table('tipo_informante')->insert($tipoInformante);
        }
    }
}
