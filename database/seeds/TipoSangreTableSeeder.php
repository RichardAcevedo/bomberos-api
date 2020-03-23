<?php

use Illuminate\Database\Seeder;

class TipoSangreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_sangre')->delete();

        $tiposSangre =
        [
            ['nombre' => 'A+'],
            ['nombre' => 'B+'],
            ['nombre' => 'O+'],
            ['nombre' => 'AB+'],
            ['nombre' => 'A-'],
            ['nombre' => 'B-'],
            ['nombre' => 'O-'],
            ['nombre' => 'AB-'],
        ];

        foreach ($tiposSangre as $tipoSangre) {
            DB::table('tipo_sangre')->insert($tipoSangre);
        }
    }
}
