<?php

use Illuminate\Database\Seeder;

class IdiomaEmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('idioma_empleado')->delete();

        $idiomasEmpleado =
        [
            ['id_idioma' => 1, 'id_empleado' => 1],
        ];

        foreach ($idiomasEmpleado as $idiomaEmpleado) {
            DB::table('idioma_empleado')->insert($idiomaEmpleado);
        }
    }
}
