<?php

use Illuminate\Database\Seeder;

class CategoriaRangoTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('categoria_rango')->delete();

        $categoriasRango =
        [
            ['nombre' => 'Oficiales'],
            ['nombre' => 'Suboficiales'],
            ['nombre' => 'Bomberos'],
            ['nombre' => 'Alumnos'],
            ['nombre' => 'Aspirantes'],
            ['nombre' => 'Bomberitos'],
            ['nombre' => 'Honorario'],
            ['nombre' => 'Administrativo'],
        ];

        foreach ($categoriasRango as $categoriaRango) {
            DB::table('categoria_rango')->insert($categoriaRango);
        }
    }
}
