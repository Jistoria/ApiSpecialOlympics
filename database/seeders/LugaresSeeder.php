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
                'nombre' => 'Uleam',
                'descripcion' => 'Estadio dedicado a eventos deportivos y culturales',
                'url_images' => json_encode(['public/images/uleam_entrada_uno.jpg','public/images/uleam_plaza.jpg']),
            ],
            [
                'nombre' => 'Uleam Pista Atletica',
                'descripcion' => 'Estadio dedicado a eventos deportivos y culturales',
                'url_images' => json_encode(['{public/images/uleam_pista_atletica.jpg','public/images/uleam_pista_atletica2.jpg}']),
            ],
            [
                'nombre' => 'Piscina Olímpica de L.D.C - Manta  complejo deportivo Tohalli',
                'descripcion' => 'Instalación deportiva para diversas disciplinas',
            ],
            [
                'nombre' => 'Hotel Windham',
                'descripcion' => 'Espacio para actividades físicas y recreativas',
            ],
            [
                'nombre' => 'Cancha Sintética Fulbito Full Soccer',
                'descripcion' => 'Instalación para deportes acuáticos y natación',
            ],
            [
                'nombre' => 'Cancha Sintetica Fulbito Full Soccer',
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
