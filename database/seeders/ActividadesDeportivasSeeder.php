<?php

namespace Database\Seeders;

use App\Models\ActividadDeportiva;
use App\Models\Deporte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActividadesDeportivasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los deportes
        $deportes = Deporte::all();

        // Array con las actividades deportivas por deporte
        $actividades_por_deporte = [
            'Atletismo' => [
                'AT 50M Carrera' => 'Carrera de velocidad de 50 metros.',
                'AT 100M Carrera' => 'Carrera de velocidad de 100 metros.',
                'AT 200M Carrera' => 'Carrera de velocidad de 200 metros.',
                'AT 400M Carrera' => 'Carrera de velocidad de 400 metros.',
                'AT 800M Carrera' => 'Carrera de medio fondo de 800 metros.',
                'AT 1500M Carrera' => 'Carrera de medio fondo de 1500 metros.',
                'AT 3000M Carrera' => 'Carrera de fondo de 3000 metros.',
                'AT 5000M Carrera' => 'Carrera de fondo de 5000 metros.',
                'AT 10000M Carrera' => 'Carrera de fondo de 10000 metros.',
                'AT 110M Vallas' => 'Carrera de 110 metros con vallas.',
                'AT 400M Vallas' => 'Carrera de 400 metros con vallas.',
                'AT 3000M Obstáculos' => 'Carrera de 3000 metros con obstáculos.',
                'AT 4X100 Relevo' => 'Carrera de relevos de 4x100 metros.',
                'AT 4X400 Relevo' => 'Carrera de relevos de 4x400 metros.',
                'AT Salto Alto' => 'Competencia de salto alto.',
                'AT Salto Largo' => 'Competencia de salto largo.',
                'AT Salto Triple' => 'Competencia de salto triple.',
                'AT Salto con Pértiga' => 'Competencia de salto con pértiga.',
                'AT Lanzamiento de Peso' => 'Competencia de lanzamiento de peso.',
                'AT Lanzamiento de Disco' => 'Competencia de lanzamiento de disco.',
                'AT Lanzamiento Martillo' => 'Competencia de lanzamiento de martillo.',
                'AT Lanzamiento Jabalina' => 'Competencia de lanzamiento de jabalina.',
                'AT Lanzamiento Bala' => 'Competencia de lanzamiento de bala.',
                'AT Lanzamiento Bala Mujeres' => 'Competencia de lanzamiento de bala.',
            ],
            'Natación' => [
                'AQ 25M' => 'Natación en piscina de 25 metros.',
                'AQ 25M Libre' => 'Natación en piscina de 25 metros.',
                'AQ 50M' => 'Natación en piscina de 50 metros.',
                'AQ 100M' => 'Natación en piscina de 100 metros',
                'AQ 200M' => 'Natación en piscina de 200 metros',
                'AQ 4X25 Relevos' => 'Relevos de natación en piscina de 4x25 metros.',
                'AQ 4X50 Relevos' => 'Relevos de natación en piscina de 4x25 metros.',
                'AQ 4X50 Relevos Libre' => 'Relevos de natación en piscina de 4x50 metros.',
                'AQ 4X25 Relevos Libre' => 'Relevos de natación en piscina de 4x25 metros.',
                'AQ 25M Pecho' => 'Natación estilo pecho en piscina de 50 metros.',
                'AQ 50M Pecho' => 'Natación estilo pecho en piscina de 50 metros.',
                'AQ 50M Libre' => 'Natación estilo libre en piscina de 50 metros.',
                'AQ 100M Libre' => 'Natación estilo libre en piscina de 100 metros.',
                'AQ 200M Libre' => 'Natación estilo libre en piscina de 200 metros.',
                'AQ 100M Mariposa' => 'Natación estilo mariposa en piscina de 100 metros.',
                'AQ 50M Mariposa' => 'Natación estilo mariposa en piscina de 100 metros.',
                'AQ 25M Espalda' => 'Natación estilo espalda en piscina de 25 metros.',
                'AQ 50M Espalda' => 'Natación estilo espalda en piscina de 50 metros.',
                'AQ 100M Espalda' => 'Natación estilo espalda en piscina de 100 metros.',
                'AQ 400M Libre' => 'Natación estilo libre en piscina de 400 metros.',
                'AQ 100M Pecho' => 'Natación estilo pecho en piscina de 100 metros.',
                'AQ 200M Combinado' => 'Natación estilo combinado en piscina de 200 metros.',
                'AQ 800M Libre' => 'Natación estilo libre en piscina de 800 metros.',
            ],
            'Gimnasia Artística' => [
                'Rutina de suelo' => 'Rutina de gimnasia artística en el suelo.',
                'Ejercicios en barras asimétricas' => 'Ejercicios de gimnasia artística en barras asimétricas.',
            ],
            'Gimnasia Rítmica' => [
                'GY Rhythmic Aro' => 'Rutina de gimnasia rítmica con aro.',
                'GY Rhythmic Clavas' => 'Rutina de gimnasia rítmica con clavas.',
                'GY Rhythmic Cinta' => 'Rutina de gimnasia rítmica con cinta.',
                'GY Rhythmic Pelota' => 'Rutina de gimnasia rítmica con pelota.',
                'GY Rhythmic Mazas' => 'Rutina de gimnasia rítmica con mazas.',
                'GY Rhythmic Cuerda' => 'Runtina de gimnasia rítmica con cuerda.',
                'GY Rhythmic All Around' => 'Rutina de gimnasia rítmica de tres eventos ',
            ],
            'Triatlón' => [
                'TR Triatlón' => 'Competencia de triatlón que incluye natación, ciclismo y carrera a pie.',
            ],
            'Levantamiento de Potencia' => [
                'PL Sentadilla' => 'Competencia de levantamiento de potencia en sentadillas.',
                'PL Peso Muerto' => 'Competencia de levantamiento de potencia en peso muerto.',
                'PL Masculino Sentadilla' => 'Competencia de levantamiento de potencia en sentadillas.',
                'PL Femenino Sentadilla' => 'Competencia de levantamiento de potencia en sentadillas.',
                'PL Press de Banca' => 'Competencia de levantamiento de potencia en press de banca.',
                'PL Masculino Press de Banca' => 'Competencia de levantamiento de potencia en press de banca.',
                'PL Masculino Peso Muerto' => 'Competencia de levantamiento de potencia en peso muerto.',
            ],
            'Fútbol' => [
                'FB Football Futsal' => 'Partido de fútbol futsal.',

            ],
        ];


        // Iterar sobre cada deporte y agregar las actividades deportivas
        foreach ($deportes as $deporte) {
            if (isset($actividades_por_deporte[$deporte->deporte])) {
                foreach ($actividades_por_deporte[$deporte->deporte] as $actividad => $descripcion) {
                    ActividadDeportiva::create([
                        'deporte_id' => $deporte->deporte_id,
                        'actividad' => $actividad,
                        'descripcion' => $descripcion,
                    ]);
                }
            }
        }

    }
}
