<?php

use Illuminate\Database\Seeder;

class DepartamentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departamento')->delete();

        $departamentos =
        [
            ['abreviado' => 'AM', 'nombre' => 'Amazonas'],
            ['abreviado' => 'AN', 'nombre' => 'Antioquia'],
            ['abreviado' => 'AP', 'nombre' => 'San Andrés y Providencia'],
            ['abreviado' => 'AR', 'nombre' => 'Arauca'],
            ['abreviado' => 'AT', 'nombre' => 'Atlántico'],
            ['abreviado' => 'BL', 'nombre' => 'Bolívar'],
            ['abreviado' => 'BY', 'nombre' => 'Boyacá'],
            ['abreviado' => 'CA', 'nombre' => 'Caldas'],
            ['abreviado' => 'CE', 'nombre' => 'Cesar'],
            ['abreviado' => 'CN', 'nombre' => 'Cundinamarca'],
            ['abreviado' => 'CO', 'nombre' => 'Chocó'],
            ['abreviado' => 'CQ', 'nombre' => 'Caquetá'],
            ['abreviado' => 'CR', 'nombre' => 'Córdoba'],
            ['abreviado' => 'CS', 'nombre' => 'Casanare'],
            ['abreviado' => 'CU', 'nombre' => 'Cauca'],
            ['abreviado' => 'GA', 'nombre' => 'Güainia'],
            ['abreviado' => 'GJ', 'nombre' => 'La Guajira'],
            ['abreviado' => 'GU', 'nombre' => 'Guaviare'],
            ['abreviado' => 'HU', 'nombre' => 'Huila'],
            ['abreviado' => 'MA', 'nombre' => 'Magdalena'],
            ['abreviado' => 'ME', 'nombre' => 'Meta'],
            ['abreviado' => 'NA', 'nombre' => 'Nariño'],
            ['abreviado' => 'NS', 'nombre' => 'Norte de Santander'],
            ['abreviado' => 'PU', 'nombre' => 'Putumayo'],
            ['abreviado' => 'QI', 'nombre' => 'Quindio'],
            ['abreviado' => 'RI', 'nombre' => 'Risaralda'],
            ['abreviado' => 'SS', 'nombre' => 'Santander'],
            ['abreviado' => 'SU', 'nombre' => 'Sucre'],
            ['abreviado' => 'TO', 'nombre' => 'Tolima'],
            ['abreviado' => 'VA', 'nombre' => 'Vaupés'],
            ['abreviado' => 'VC', 'nombre' => 'Valle del Cauca'],
            ['abreviado' => 'VI', 'nombre' => 'Vichada'],
        ];

        foreach ($departamentos as $departamento) {
            DB::table('departamento')->insert($departamento);
        }
    }
}
