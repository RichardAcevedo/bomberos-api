<?php

use Illuminate\Database\Seeder;

class TipoEmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_empresa')->delete();

        $tiposEmpresa =
        [
            ['nombre' => 'INDUSTRIALES'],
            ['nombre' => 'COMERCIALES'],
            ['nombre' => 'DE SERVICIOS'],
            ['nombre' => 'MOTEL'],
            ['nombre' => 'COLEGIOS'],
            ['nombre' => 'INSTITUCIONES'],
        ];

        foreach ($tiposEmpresa as $tipoEmpresa) {
            DB::table('tipo_empresa')->insert($tipoEmpresa);
        }
    }
}
