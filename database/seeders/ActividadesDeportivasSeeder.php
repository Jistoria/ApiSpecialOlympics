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
            'Atletismo' => ['Carrera de 100 metros', 'Salto de longitud'],
            'Baloncesto' => ['Partido de entrenamiento', 'Concurso de tiros libres'],
            'Ciclismo' => ['Carrera de ruta', 'Ciclismo de montaña'],
            'Fútbol' => ['Partido amistoso', 'Entrenamiento de penales'],
            'Fútbol Destrezas' => ['Competencia de regates', 'Entrenamiento de habilidades'],
            'Gimnasia Artística' => ['Rutina de suelo', 'Ejercicios en barras asimétricas'],
            'Gimnasia Rítmica' => ['Rutina con cinta', 'Rutina con aro'],
            'Natación' => ['Carrera de estilo libre', 'Clases de técnica de natación'],
            'Tenis' => ['Partido individual', 'Entrenamiento de saques'],
        ];

        // Iterar sobre cada deporte y agregar las actividades deportivas
        foreach ($deportes as $deporte) {
            if (isset($actividades_por_deporte[$deporte->deporte])) {
                foreach ($actividades_por_deporte[$deporte->deporte] as $actividad) {
                    ActividadDeportiva::create([
                        'deporte_id' => $deporte->deporte_id,
                        'actividad' => $actividad,
                        'descripcion' => "Actividad de $deporte->deporte: $actividad",
                    ]);
                }
            }
        }
    }
}
