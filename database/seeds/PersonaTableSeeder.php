<?php

use Illuminate\Database\Seeder;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persona')->delete();

        $personas =
        [
            ['nombre' => 'Jean Polo Cequeda Olago', 'fecha_nacimiento' => '1981-07-11', 'sexo' => 'M' , 'vive' => 'Si', 'barrio' => 'Turbay Ayala', 'direccion' => 'Cra 15 # 1-45  Villa del Rosario', 'telefono' => '5709818', 'celular' => '3164641755', 'estado_civil' => 'Soltero(a)', 'documento' => '88195583', 'estatura' => '1.83', 'peso' => '97', 'email' => 'rocio.cequeda@hotmail.com', 'fotografia' => null, 'id_tipo_sangre' => 1, 'id_ciudad_nacimiento' => 823, 'id_profesion' => 33],
            
        ];

        foreach ($personas as $persona) {
            DB::table('persona')->insert($persona);
        }
    }
}

