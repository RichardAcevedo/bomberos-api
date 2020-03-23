<?php

use Illuminate\Database\Seeder;

class AsuntoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('asunto')->delete();

        $asuntos =
        [
            ['nombre' => 'Recepción de emergencia'],
            ['nombre' => 'Entrada de personal'],
            ['nombre' => 'Salida de personal'],
            ['nombre' => 'Entrada de máquina'],
            ['nombre' => 'Salida de máquina'],
            ['nombre' => 'Entrada visitante'],
            ['nombre' => 'Salida visitante'],
            ['nombre' => 'Entrada extintor(es)'],
            ['nombre' => 'Salida extintor(es)'],
            ['nombre' => 'Relevo'],
            ['nombre' => 'Novedades en máquinas'],
            ['nombre' => 'Nota'],
        ];

        foreach ($asuntos as $asunto) {
            DB::table('asunto')->insert($asunto);
        }
    } 
}
