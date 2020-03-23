<?php

use Illuminate\Database\Seeder;

class CargoTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('cargo')->delete();

        $cargos =
        [
            ['nombre' => 'Comandante'],
            ['nombre' => 'Subcomandante'],
            ['nombre' => 'Revisor(a) Fiscal'],
            ['nombre' => 'Lider Área de Talento Humano'],
            ['nombre' => 'Lider Área de Operaciones '],
            ['nombre' => 'Lider Área de Prevencion '],
            ['nombre' => 'Lider Área de Capacitación'],
            ['nombre' => 'Lider Área Comercial'],
            ['nombre' => 'Lider Área Financiera'],
            ['nombre' => 'Lider Área de Telemática y Socialmedia'],
            ['nombre' => 'Asistente de Operaciones'],
            ['nombre' => 'Asistente de Logística'],
            ['nombre' => 'Asistente de Telemática'],
            ['nombre' => 'Supervisor(a) de Seguridad '],
            ['nombre' => 'Tesorero(a)'],
            ['nombre' => 'Auxiliar Contable'],
            ['nombre' => 'Asesor Jurídico'],
            ['nombre' => 'Secretario(a)'],
            ['nombre' => 'Maquinista'],
            ['nombre' => 'Presidente Consejo de Oficiales'],
            ['nombre' => 'Secretario(a) Consejo de Oficiales'],
            ['nombre' => 'Auxiliar Administrativo'],
        ];

        foreach ($cargos as $cargo) {
            DB::table('cargo')->insert($cargo);
        }
    }
}
