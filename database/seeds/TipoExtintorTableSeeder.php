<?php

use Illuminate\Database\Seeder;

class TipoExtintorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_extintor')->delete();

        $tiposExtintor =
        [
            ['nombre' => 'H2O', 'unidad' => '12', 'cantidad' => 3341],
            ['nombre' => 'P.Q.S 2 1/2 LBS', 'unidad' => '1', 'cantidad' => 1],
            ['nombre' => 'Espuma', 'unidad' => '2', 'cantidad' => 2],
            ['nombre' => 'Polvo Qumico Seco', 'unidad' => '2', 'cantidad' => 13],
        ];

        foreach ($tiposExtintor as $tipoExtintor) {
            DB::table('tipo_extintor')->insert($tipoExtintor);
        }
    }
}
