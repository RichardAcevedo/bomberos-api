<?php

use Illuminate\Database\Seeder;

class EventoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('evento')->delete();

        $eventos =
        [
            ['nombre' => 'ACCIDENTE AÉREO'],
            ['nombre' => 'ACCIDENTE DE TRÁNSITO'],
            ['nombre' => 'ACCIDENTE FLUVIAL'],
            ['nombre' => 'ACCIDENTE MARÍTIMO'],
            ['nombre' => 'ACCIDENTE MINERO'],
            ['nombre' => 'ACTIVIDADES DE PREVENCIÓN: (INSPECCIONES DE SEGURIDAD A EDIFICACIONES, VERIFICACIONES, MONITOREO DE FUENTES HÍDRICAS, SIMULACROS'],
            ['nombre' => 'ATENCIÓN PREHOSPITALARIA'],
            ['nombre' => 'AVENIDA TORRENCIAL'],
            ['nombre' => 'BÚSQUEDA Y RECUPERACIÓN DE CUERPO'],
            ['nombre' => 'BÚSQUEDA Y RESCATE DE PERSONA'],
            ['nombre' => 'CAÍDA DE ÁRBOL'],
            ['nombre' => 'COLAPSO'],
            ['nombre' => 'CONTROL DE ABEJAS'],
            ['nombre' => 'CRECIENTE SÚBITA'],
            ['nombre' => 'DERRAME DE HIDROCARBURO'],
            ['nombre' => 'DESABASTECIMIENTO DE AGUA'],
            ['nombre' => 'DESBORDAMIENTO'],
            ['nombre' => 'DESLIZAMIENTO'],
            ['nombre' => 'EXPLOSIÓN'],
            ['nombre' => 'FALLA ELÉCTRICA'],
            ['nombre' => 'FALSA ALARMA'],
            ['nombre' => 'FUGA DE GAS'],
            ['nombre' => 'GRANIZADA'],
            ['nombre' => 'INCENDIO DE INTERFACE '],
            ['nombre' => 'INCENDIO ESTRUCTURAL'],
            ['nombre' => 'INCENDIO FORESTAL'],
            ['nombre' => 'INCENDIO VEHICULAR'],
            ['nombre' => 'INUNDACIÓN'],
            ['nombre' => 'MATERIALES PELIGROSOS'],
            ['nombre' => 'OTROS'],
            ['nombre' => 'OTROS - APOYO OPERATIVO'],
            ['nombre' => 'OTROS - CAPACITACIÓN'],
            ['nombre' => 'OTROS - DESPLAZAMIENTO SIN INTERVENCIÓN'],
            ['nombre' => 'OTROS - ENTREGA DE AYUDAS HUMANITARIAS'],
            ['nombre' => 'OTROS - EVENTOS MASIVOS'],
            ['nombre' => 'OTROS - RESCATE CASOS SUICIDA '],
            ['nombre' => 'OTROS - SERVICIOS ESPECIALES A LA COMUNIDAD'],
            ['nombre' => 'QUEMAS PROHIBIDAS'],
            ['nombre' => 'RESCATE ANIMAL'],
            ['nombre' => 'SEQUÍA'],
            ['nombre' => 'SISMO'],
            ['nombre' => 'TORMENTA ELÉCTRICA'],
            ['nombre' => 'TRASLADO DE PACIENTE'],
            ['nombre' => 'VENDAVAL'],
        ];

        foreach ($eventos as $evento) {
            DB::table('evento')->insert($evento);
        }
    } 
}
