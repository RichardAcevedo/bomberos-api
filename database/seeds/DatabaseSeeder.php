<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DepartamentoTableSeeder::class,
            CiudadTableSeeder::class,
            AsuntoTableSeeder::class,
            EventoTableSeeder::class,
            NovedadVehiculoTableSeeder::class,
            CargoTableSeeder::class,
            IdiomaTableSeeder::class,
            TipoEmpresaTableSeeder::class,
            TipoInformanteTableSeeder::class,
            TipoExtintorTableSeeder::class,
            TipoVehiculoTableSeeder::class,
            TipoCondecoracionTableSeeder::class,
            TipoUsuarioTableSeeder::class,
            TipoSangreTableSeeder::class,
            ProfesionTableSeeder::class,
            CategoriaRangoTableSeeder::class,
            CategoriaLicenciaTableSeeder::class,
            EmergenciaTableSeeder::class,
            PersonaTableSeeder::class,
            EmpleadoTableSeeder::class,
            IdiomaEmpleadoTableSeeder::class,
            RangoTableSeeder::class,
            VehiculoTableSeeder::class,
        ]); 
    }   
}
