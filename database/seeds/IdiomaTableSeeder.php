<?php

use Illuminate\Database\Seeder;

class IdiomaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('idioma')->delete();

        $personas =
        [
            ['nombre' => 'Español'],
            ['nombre' => 'Inglés'],
            ['nombre' => 'Portugues'],
            ['nombre' => 'Francés'],
            ['nombre' => 'Japonés'],
            ['nombre' => 'Arabe'],
            ['nombre' => 'Alemán'],
            
        ];

        foreach ($personas as $persona) {
            DB::table('idioma')->insert($persona);
        }
    }
}
