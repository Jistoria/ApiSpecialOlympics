<?php

namespace Database\Seeders;

use App\Models\Deporte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeportesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array con los nombres de los deportes y sus descripciones
        $deportes = [
            ['deporte' => 'Atletismo', 'descripcion' => 'Deporte que involucra carreras, saltos y lanzamientos'],
            ['deporte' => 'Baloncesto', 'descripcion' => 'Deporte de equipo jugado en una cancha rectangular'],
            ['deporte' => 'Ciclismo', 'descripcion' => 'Deporte que implica montar en bicicleta'],
            ['deporte' => 'Fútbol', 'descripcion' => 'Deporte de equipo jugado con un balón en una cancha rectangular'],
            ['deporte' => 'Fútbol Destrezas', 'descripcion' => 'Modalidad de fútbol que se centra en las habilidades individuales'],
            ['deporte' => 'Gimnasia Artística', 'descripcion' => 'Deporte que involucra movimientos acrobáticos y de equilibrio'],
            ['deporte' => 'Gimnasia Rítmica', 'descripcion' => 'Deporte que combina elementos de danza y gimnasia'],
            ['deporte' => 'Natación', 'descripcion' => 'Deporte que implica nadar en agua'],
            ['deporte' => 'Tenis', 'descripcion' => 'Deporte de raqueta jugado en una cancha rectangular'],
        ];

        // Iterar sobre el array de deportes y crear registros en la base de datos
        foreach ($deportes as $deporte) {
            Deporte::create([
                'deporte' => $deporte['deporte'],
                'descripcion' => $deporte['descripcion'],
            ]);
        }
    }
}
