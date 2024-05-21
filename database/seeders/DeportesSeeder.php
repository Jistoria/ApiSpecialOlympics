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
            ['deporte' => 'Atletismo', 'descripcion' => 'Deporte que involucra carreras, saltos y lanzamientos','icon'=>'sports_handball'],
            ['deporte' => 'Fútbol', 'descripcion' => 'Deporte de equipo jugado con un balón en una cancha rectangular', 'icon'=>'sports_soccer'],
            ['deporte' => 'Triatlón', 'descripcion' => 'Deporte que combina natación, ciclismo y carrera','icon'=>'directions_bike'],
            ['deporte' => 'Levantamiento de Potencia', 'descripcion'=>'Deporte que consiste en levantar el mayor peso posible en una sola repetición','icon'=>'sports_soccer'],
            ['deporte' => 'Natación', 'descripcion'=>'Deporte para demostrar tus destrezas en el agua','icon'=>'pool'],
            ['deporte' => 'Gimnasia Rítmica', 'descripcion'=>'Deporte para demostrar tu concentración y tiempo','icon'=>'sports_gymnastics'],
        ];

        // Iterar sobre el array de deportes y crear registros en la base de datos
        foreach ($deportes as $deporte) {
            Deporte::create([
                'deporte' => $deporte['deporte'],
                'descripcion' => $deporte['descripcion'],
                'icon'=>$deporte['icon'],
            ]);
        }
    }
}
