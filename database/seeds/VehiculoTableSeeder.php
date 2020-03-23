<?php

use Illuminate\Database\Seeder;

class VehiculoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehiculo')->delete();

        $vehiculos =
        [
            ['nombre' => 'Máquina 12-01', 'marca' => 'Foton', 'modelo' => 'Aumamark 2015', 'placa' => 'ODQ014', 'id_tipo_vehiculo' => 4],
            ['nombre' => 'Máquina 12-02', 'marca' => 'Foton', 'modelo' => 'Tunland 2015', 'placa' => 'ODQ017', 'id_tipo_vehiculo' => 3],
            ['nombre' => 'Máquina 12-03', 'marca' => 'Ford  Econ 350', 'modelo' => '2001', 'placa' => 'ODQ015', 'id_tipo_vehiculo' => 2],
            ['nombre' => 'Máquina 12-04', 'marca' => 'Chevrolet', 'modelo' => 'Dimax 2016', 'placa' => '1204', 'id_tipo_vehiculo' => 5],
            ['nombre' => 'Máquina 12-05', 'marca' => 'Ford', 'modelo' => '150 1884', 'placa' => 'OJG-457', 'id_tipo_vehiculo' => 5],
        ];

        foreach ($vehiculos as $vehiculo) {
            DB::table('vehiculo')->insert($vehiculo);
        }
    }
}
