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
                'AT 50 M' => 'Carrera de velocidad de 50 metros.',
                'AT 100 M' => 'Carrera de velocidad de 100 metros.',
                'AT 200 M' => 'Carrera de velocidad de 200 metros.',
                'AT 400 M' => 'Carrera de velocidad de 400 metros.',
                'AT 800 M' => 'Carrera de medio fondo de 800 metros.',
                'AT 1500 M' => 'Carrera de medio fondo de 1500 metros.',
                'AT 3000 M' => 'Carrera de fondo de 3000 metros.',
                'AT 5000 M' => 'Carrera de fondo de 5000 metros.',
                'AT 10000 M' => 'Carrera de fondo de 10000 metros.',
                'AT 110 M Vallas' => 'Carrera de 110 metros con vallas.',
                'AT 400 M Vallas' => 'Carrera de 400 metros con vallas.',
                'AT 3000 M Obstáculos' => 'Carrera de 3000 metros con obstáculos.',
                'AT 4x100 Relevos' => 'Carrera de relevos de 4x100 metros.',
                'AT 4x400 Relevos' => 'Carrera de relevos de 4x400 metros.',
                'AT Salto Alto' => 'Competencia de salto alto.',
                'AT Salto Largo' => 'Competencia de salto largo.',
                'AT Salto Triple' => 'Competencia de salto triple.',
                'AT Salto con Pértiga' => 'Competencia de salto con pértiga.',
                'AT Lanzamiento de Peso' => 'Competencia de lanzamiento de peso.',
                'AT Lanzamiento de Disco' => 'Competencia de lanzamiento de disco.',
                'AT Lanzamiento de Martillo' => 'Competencia de lanzamiento de martillo.',
                'AT Lanzamiento de Jabalina' => 'Competencia de lanzamiento de jabalina.',
                'AT Lanzamiento de Bala' => 'Competencia de lanzamiento de bala.',
            ],
            'Natación' => [
                'AQ 25 M' => 'Natación en piscina de 25 metros.',
                'AQ 50 M' => 'Natación en piscina de 50 metros.',
                'AQ 100 M' => 'Natación en piscina de 100 metros',
                'AQ 200 M' => 'Natación en piscina de 200 metros',
                'AQ 4 X 25 Relevos' => 'Relevos de natación en piscina de 4x25 metros.',
                'AQ 50 M Pecho' => 'Natación estilo pecho en piscina de 50 metros.',
                'AQ 50 M Libre' => 'Natación estilo libre en piscina de 50 metros.',
                'AQ 100 M Libre' => 'Natación estilo libre en piscina de 100 metros.',
                'AQ 100 M Mariposa' => 'Natación estilo mariposa en piscina de 100 metros.',
                'AQ 25 M Espalda' => 'Natación estilo espalda en piscina de 25 metros.',
                'AQ 50 M Espalda' => 'Natación estilo espalda en piscina de 50 metros.',
                'AQ 100 M Espalda' => 'Natación estilo espalda en piscina de 100 metros.',
                'AQ 100 M Pecho' => 'Natación estilo pecho en piscina de 100 metros.',
                'AQ 200 M Combinado' => 'Natación estilo combinado en piscina de 200 metros.',
            ],
            'Gimnasia Artística' => [
                'Rutina de suelo' => 'Rutina de gimnasia artística en el suelo.',
                'Ejercicios en barras asimétricas' => 'Ejercicios de gimnasia artística en barras asimétricas.',
            ],
            'Gimnasia Rítmica' => [
                'GY Aro' => 'Rutina de gimnasia rítmica con aro.',
                'GY Clavas' => 'Rutina de gimnasia rítmica con clavas.',
                'GY Cinta' => 'Rutina de gimnasia rítmica con cinta.',
                'GY Pelota' => 'Rutina de gimnasia rítmica con pelota.',
                'GY Mazas' => 'Rutina de gimnasia rítmica con mazas.',
            ],
            'Triathlón' => [
                'Triatlón' => 'Competencia de triatlón que incluye natación, ciclismo y carrera a pie.',
            ],
            'Levantamiento de Potencia' => [
                'PL Sentadillas' => 'Competencia de levantamiento de potencia en sentadillas.',
                'PL Press de Banca' => 'Competencia de levantamiento de potencia en press de banca.',
                'PL Peso Muerto' => 'Competencia de levantamiento de potencia en peso muerto.',
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
