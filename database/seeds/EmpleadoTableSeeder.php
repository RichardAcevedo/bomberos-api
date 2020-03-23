<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class EmpleadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleado')->delete();
        $contraseña = Crypt::encryptString("12345678");
        $empleados =
        [
            // password:12345678
            ['codigo' => '0000', 'password' => $contraseña, 'fecha_ingreso' => '2011-12-01', 'activo' => 'Si', 'tipo_casa' => 'Arrendada', 'computador' => 'Si', 'id_tipo_usuario' => 1, 'id_ciudad' => 823, 'id_persona' => 1],
            
        ];

        foreach ($empleados as $empleado) {
            DB::table('empleado')->insert($empleado);
        }
    }
}
