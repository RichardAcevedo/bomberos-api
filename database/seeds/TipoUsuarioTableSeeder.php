<?php

use Illuminate\Database\Seeder;

class TipoUsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_usuario')->delete();

        $tiposUsuario =
        [
            ['nombre' => 'Administrador General', 'slug' => 'administrador-general'],
            ['nombre' => 'Minuta', 'slug' => 'minuta'],
            ['nombre' => 'Maquinista', 'slug' => 'maquinista'],
            ['nombre' => 'Prevención y Seguridad', 'slug' => 'prevencion-y-seguridad'],
            ['nombre' => 'Extintores', 'slug' => 'extintores'],
            ['nombre' => 'Personal', 'slug' => 'personal'],
            ['nombre' => 'Supervisor', 'slug' => 'supervisor'],
            ['nombre' => 'Normal', 'slug' => 'normal'],
        ];

        foreach ($tiposUsuario as $tipoUsuario) {
            DB::table('tipo_usuario')->insert($tipoUsuario);
        }
    }
}
