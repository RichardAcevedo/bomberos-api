<?php

use Illuminate\Database\Seeder;

class ProfesionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profesion')->delete();

        $profesiones =
        [
            ['nombre' => 'Abogado(a)', 'descripcion' => 'Persona que defiende, representa o acusa a una persona en un juicio.'],
            ['nombre' => 'Actor/Actriz', 'descripcion' => 'Persona que actúa en obras de teatro, series o películas.'],
            ['nombre' => 'Agente de viaje', 'descripcion' => 'Persona que vende y organiza viajes, vacaciones y vuelos.'],
            ['nombre' => 'Arquitecto(a)', 'descripcion' => 'Persona que diseña edificios y casas, los diseños los representa en planos.'],
            ['nombre' => 'Astrónomo(a)', 'descripcion' => 'Científico que observa el cielo y el universo, normalmente con telescopios.'],
            ['nombre' => 'Autor(a)', 'descripcion' => 'Persona que escribe libros, novelas o libretos.'],
            ['nombre' => 'Barrendero(a)', 'descripcion' => 'Persona que limpia los lugares públicos (calles, plazas, etc.)'],
            ['nombre' => 'Bibliotecario(a)', 'descripcion' => 'Persona que trabaja en una biblioteca manteniendo el orden de los libros, videos, discos, etc.'],
            ['nombre' => 'Bombero(a)', 'descripcion' => '(1) Persona que apaga el fuego en un incendio. (2) Persona que carga combustible en una estación de servicios (Chile)'],
            ['nombre' => 'Carabinero(a) (Chile)', 'descripcion' => 'Persona que trabaja en el cuerpo de carabineros, previenen el crimen. (Policía)'],
            ['nombre' => 'Cartero(a)', 'descripcion' => 'Persona que lleva las cartas hasta tu casa.'],
            ['nombre' => 'Carnicero(a)', 'descripcion' => 'Persona que trabaja con carne. Ellos cortan la carne y la venden.'],
            ['nombre' => 'Carpintero(a)', 'descripcion' => 'Persona que trabaja con madera haciendo casas o creando muebles.'],
            ['nombre' => 'Científico(a)', 'descripcion' => 'Persona que trabaja en investigaciones científicas haciendo muchos experimentos.'],
            ['nombre' => 'Cirujano(a)', 'descripcion' => 'Persona que profesa la cirugía.'],
            ['nombre' => 'Conductor(a) de bus', 'descripcion' => 'Persona que conduce o maneja buses.'],
            ['nombre' => 'Contador(a)', 'descripcion' => 'Persona que trabaja con el dinero y trabaja con las cuentas de una compañía.'],
            ['nombre' => 'Corredor de propiedades', 'descripcion' => 'Persona que vende o arrienda casas a otros.'],
            ['nombre' => 'Chef/Cocinero(a)', 'descripcion' => 'Persona que prepara comida para otros, comúnmente en un restaurante.'],
            ['nombre' => 'Dentista', 'descripcion' => 'Persona que soluciona los problemas de los dientes.'],
            ['nombre' => 'Diseñador(a)', 'descripcion' => 'Persona que diseña creativamente diferentes cosas, por ejemplo, ropa, muebles, papelería, etc.'],
            ['nombre' => 'Doctor(a)', 'descripcion' => 'Persona a la que vas cuando tienes problemas de salud.'],
            ['nombre' => 'Electricista', 'descripcion' => 'Persona que trabaja haciendo instalaciones eléctricas.'],
            ['nombre' => 'Enfermero(a)', 'descripcion' => 'Persona que cuida a enfermos o a personas que están en un proceso de recuperación siguiendo las ordenes del doctor (trabajan en un hospital o clínica).'],
            ['nombre' => 'Estilista', 'descripcion' => 'Persona que corta el pelo y hace peinados, generalmente trabaja en un salón de belleza o peluquería.'],
            ['nombre' => 'Farmacéutico(a)', 'descripcion' => 'Persona calificada que trabaja en una farmacia, chequea las prescripciones médicas o aconseja a los enfermos a comprar algún tipo de medicamentos.'],
            ['nombre' => 'Fontanero(a)', 'descripcion' => 'Persona que repara las tuberías de agua o gas y realiza instalaciones de agua potable. Sinónimo: Plomero (También ver Gásfiter y Gasfitero)'],
            ['nombre' => 'Florista', 'descripcion' => 'Persona que trabaja en la producción de flores y diseña arreglos florales.'],
            ['nombre' => 'Fotógrafo(a)', 'descripcion' => 'Persona que toma fotos de distintas cosas, por ejemplo de paisajes, personas, detalles, etc.'],
            ['nombre' => 'Gásfiter', 'descripcion' => 'Persona que repara las tuberías de agua o gas. (Chile)'],
            ['nombre' => 'Gasfitero', 'descripcion' => 'Persona que repara las tuberías de agua o gas. (Perú)'],
            ['nombre' => 'Granjero/Campesino', 'descripcion' => 'Persona que trabaja en una granja o parcela, trabaja en la mantención de un campo con árboles frutales o ganado.'],
            ['nombre' => 'Ingeniero(a)', 'descripcion' => 'Persona con formación científica que diseña y construye productos complicados, máquinas, sistemas o estructuras'],
            ['nombre' => 'Jardinero(a)', 'descripcion' => 'Persona que trabaja en la mantención de un jardín, cuida las flores, corta el pasto, etc.'],
            ['nombre' => 'Juez(a)', 'descripcion' => 'Persona que decide en un juicio si el acusado o demandado es culpable o inocente.'],
            ['nombre' => 'Júnior', 'descripcion' => 'Persona que realiza diferentes trámites generalmente trabaja para una oficina, a veces también limpia el lugar de trabajo.'],
            ['nombre' => 'Lector(a) de noticias', 'descripcion' => 'Persona que lee noticias, por lo general en la televisión.'],
            ['nombre' => 'Limpiador(a) de vidrios', 'descripcion' => 'Persona que limpia los vidrios de un edificio muy alto.'],
            ['nombre' => 'Maestro de construcción', 'descripcion' => 'Persona que construye casas o edificios y realiza diversas reparaciones.'],
            ['nombre' => 'Mecánico(a)', 'descripcion' => 'Persona que repara máquinas, autos, camiones, motores, etc.'],
            ['nombre' => 'Mesero(a)', 'descripcion' => 'Persona que trabaja en un restaurante, atiende y sirve la comida a los clientes.'],
            ['nombre' => 'Modelo(a)', 'descripcion' => 'Persona (por lo general son atractivos) que muestra ropa o accesorios en un desfile de modas o revistas.'],
            ['nombre' => 'Oftalmólogo', 'descripcion' => 'Persona que revisa tu visión y trata de corregir problemas visuales.'],
            ['nombre' => 'Panadero(a)', 'descripcion' => 'Persona que hace pan, queques y trabaja generalmente en una panadería.'],
            ['nombre' => 'Peluquero(a)', 'descripcion' => 'Persona que tiene por oficio peinar o cortar el pelo.'],
            ['nombre' => 'Periodista', 'descripcion' => 'Persona que investiga e informa sobre las noticias, puede ser a través de un diario, revista, radio o televisión.'],
            ['nombre' => 'Pescador(a)', 'descripcion' => 'Persona que pesca peces en el mar.'],
            ['nombre' => 'Pintor(a)', 'descripcion' => '(1) Persona que pinta cuadros u obras de arte. (2) Persona que pinta casas por dentro o por fuera.'],
            ['nombre' => 'Piloto', 'descripcion' => 'Persona que pilotea aviones o aeroplanos.'],
            ['nombre' => 'Plomero(a)', 'descripcion' => 'Persona que repara las tuberías de agua o gas y realiza instalaciones de agua potable. Sinónimo: Fontanero (También ver Gásfiter y Gasfitero)'],
            ['nombre' => 'Policía', 'descripcion' => '(1) Persona que estar encargado de velar por el mantenimiento del orden público. (2) Persona que trabaja en el cuerpo de policías de investigaciones, investigan el crimen. (Chile)'],
            ['nombre' => 'Político', 'descripcion' => 'Persona que trabaja en la política.'],
            ['nombre' => 'Profesor(a)', 'descripcion' => 'Persona que enseña en una escuela, instituto, universidad y entrega el conocimiento y potencia las destrezas de un estudiante.'],
            ['nombre' => 'Psiquiatra', 'descripcion' => 'Especialista que evalua, diagnostica, trata o rehabilita a las personas con trastornos mentales'],
            ['nombre' => 'Recepcionista', 'descripcion' => 'Persona que trabaja en la recepción de una compañía, entrega información.'],
            ['nombre' => 'Salvavidas', 'descripcion' => 'Persona que salva las vidas de los bañistas en una piscina, en el mar o en un lago.'],
            ['nombre' => 'Sastre', 'descripcion' => 'Persona que hace ropas para otros, generalmente crea diseños únicos y exclusivos.'],
            ['nombre' => 'Secretario(a)', 'descripcion' => 'Persona que trabaja en una compañía escribiendo cartas, atendiendo el teléfono, organizando el horario de su jefe, etc.'],
            ['nombre' => 'Soldado', 'descripcion' => 'Persona que está en un batallón de guerra.'],
            ['nombre' => 'Taxista', 'descripcion' => 'Persona que conduce un auto y cobra una cantidad de dinero por el recorrido.'],
            ['nombre' => 'Trabajador(a) de fabrica', 'descripcion' => 'Persona que trabaja en una fabrica.'],
            ['nombre' => 'Traductor(a)', 'descripcion' => 'Persona que traduce un texto o conversaciones de un leguaje a otro sin perder la idea original.'],
            ['nombre' => 'Vendedor(a)', 'descripcion' => 'Persona que trabaja en un lugar vendiendo productos o servicios.'],
            ['nombre' => 'Veterinario(a)', 'descripcion' => 'Persona que atiende a los animales cuando están enfermos y les receta algún medicamento para que se sanen.'],
        ];

        foreach ($profesiones as $profesion) {
            DB::table('profesion')->insert($profesion);
        }
    }
}