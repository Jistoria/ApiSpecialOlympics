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
            'Atletismo' => ['AT 50 M','AT 100 M','AT 200 M','AT 400 M','AT 800 M','AT 1500 M','AT 3000 M','AT 5000 M','AT 10000 M','AT 110 M Vallas','AT 400 M Vallas','AT 3000 M Obstáculos','AT 4x100 Relevos','AT 4x400 Relevos','AT Salto Alto','AT Salto Largo','AT Salto Triple','AT Salto con Pértiga','AT Lanzamiento de Peso','AT Lanzamiento de Disco','AT Lanzamiento de Martillo','AT Lanzamiento de Jabalina','AT Lanzamiento de Bala',],
            'Natación' => ['AQ 25 M','AQ 50 M','AQ 4 X 25 Relevos', 'AQ 50 M Pecho','AQ 50 M Libre','AQ 100 M Libre','AQ 100 M Mariposa', 'AQ 25 M Espalda', 'AQ 50 M Espalda', 'AQ 100 M Espalda', 'AQ 100 M Pecho', 'AQ 100 M Mariposa', 'AQ 200 M Combinado'],
            'Gimnasia Artística' => ['Rutina de suelo', 'Ejercicios en barras asimétricas'],
            'Gimnasia Rítmica' => ['GY Aro','GY Clavas','GY Cinta','GY Pelota', 'GY Mazas'],
            'Triathlón' => ['Triatlón'],
            'Levantamiento de Potencia' => ['PL Sentadillas', 'PL Press de Banca', 'PL Peso Muerto'],
        ];


        // Iterar sobre cada deporte y agregar las actividades deportivas
        foreach ($deportes as $deporte) {
            if (isset($actividades_por_deporte[$deporte->deporte])) {
                foreach ($actividades_por_deporte[$deporte->deporte] as $actividad) {
                    ActividadDeportiva::create([
                        'deporte_id' => $deporte->deporte_id,
                        'actividad' => $actividad,
                    ]);
                }
            }
        }
    }
}
