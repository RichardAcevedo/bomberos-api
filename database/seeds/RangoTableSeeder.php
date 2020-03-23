<?php

use Illuminate\Database\Seeder;

class RangoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rango')->delete();

        $rangos =
        [
            ['nombre' => 'Capitan', 'descripcion' => 'Colocar requisitos', 'id_categoria_rango' => 1],
            ['nombre' => 'Teniente', 'descripcion' => 'Colocar requisitos', 'id_categoria_rango' => 1],
            ['nombre' => 'Subteniente', 'descripcion' => 'Colocar requisitos', 'id_categoria_rango' => 1],
            ['nombre' => 'Sargento', 'descripcion' => 'Colocar requisitos', 'id_categoria_rango' => 2],
            ['nombre' => 'Cabo', 'descripcion' => 'Colocar requisitos', 'id_categoria_rango' => 2],
            ['nombre' => 'Bombero', 'descripcion' => 'Colocar requisitos', 'id_categoria_rango' => 3],
            ['nombre' => 'Auxiliar', 'descripcion' => 'Desempeño en labores administrativas no operativas', 'id_categoria_rango' => 8],
            
        ];

        foreach ($rangos as $rango) {
            DB::table('rango')->insert($rango);
        }
    }
}
