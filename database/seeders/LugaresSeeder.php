<?php

namespace Database\Seeders;

use App\Models\Lugar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LugaresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array con los datos de los lugares
        $lugares = [
            [
                'nombre' => 'Estadio Olímpico',
                'descripcion' => 'Estadio dedicado a eventos deportivos y culturales',
            ],
            [
                'nombre' => 'Polideportivo Municipal',
                'descripcion' => 'Instalación deportiva para diversas disciplinas',
            ],
            [
                'nombre' => 'Gimnasio Recreativo',
                'descripcion' => 'Espacio para actividades físicas y recreativas',
            ],
            [
                'nombre' => 'Centro Acuático',
                'descripcion' => 'Instalación para deportes acuáticos y natación',
            ],
            // Agrega más lugares según sea necesario
        ];

        // Iterar sobre el array de lugares y crear registros en la base de datos
        foreach ($lugares as $lugar) {
            Lugar::create([
                'nombre' => $lugar['nombre'],
                'descripcion' => $lugar['descripcion'],
            ]);
        }
    }
}
