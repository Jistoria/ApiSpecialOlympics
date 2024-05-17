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
                'descripcion' => 'Universidad Laica Eloy Alfaro de Manabí',
                'url_images' => json_encode(['https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/uleam_entrada_uno.jpg?alt=media&token=8df4309c-b2c9-427d-aad8-b3c804004a3a',
                    'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/uleam_plaza.jpg?alt=media&token=c587fa54-f6f3-4d61-95bd-793f71577b9f'],JSON_UNESCAPED_SLASHES),
            ],
            [
                'nombre' => 'Uleam Pista Atletica',
                'descripcion' => 'Pista de atletismo para competencias y entrenamientos en la Universidad Laica Eloy Alfaro de Manabí',
                'url_images' => json_encode(['https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/uleam_pista_atletica.jpg?alt=media&token=e29017bb-b4cb-4ace-8ae9-872493a7a872',
                    'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/uleam_pista_atletica2.jpg?alt=media&token=ca6d5726-6663-4cc2-b66c-9924315cbff9',
                    'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/uleam_entrada_uno.jpg?alt=media&token=8df4309c-b2c9-427d-aad8-b3c804004a3a'],JSON_UNESCAPED_SLASHES),
            ],
            [
                'nombre' => 'Piscina Olímpica de L.D.C - Manta  complejo deportivo Tohalli',
                'descripcion' => 'Instalación deportiva para diversas disciplinas',
                'url_images' => json_encode(['https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/complejojpg.jpg?alt=media&token=66dd4296-341b-4c43-9715-9b615d2081bc',
                'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/piscina_olimpica_complejo.jpg?alt=media&token=024efb35-2897-4906-ad06-6e1d274e38e5',
                'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/piscina_olimpica_tohalli.jpg?alt=media&token=1d62e036-e9af-4833-884f-0721a98705ee'   ],JSON_UNESCAPED_SLASHES),
            ],
            [
                'nombre' => 'Hotel Windham',
                'descripcion' => 'Hotel de lujo con instalaciones deportivas y de entretenimiento',
                'url_images' => json_encode(['https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/hotel_windham.jpeg?alt=media&token=79dae6d4-8c91-415f-9693-7f6875afbc77',
                'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/hotel_windham2.jpg?alt=media&token=5774ecbe-4fff-47d2-a5e5-77aeb94ec98b',
                'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/hotel_windham3.jpg?alt=media&token=2b0931b4-5daf-4608-ae18-bed1b482d5df'],JSON_UNESCAPED_SLASHES),
            ],
            [
                'nombre' => 'Cancha Sintética Fulbito Full Soccer',
                'descripcion' => 'Instalación deportiva para la práctica de fútbol 5 y fútbol 7',
                'url_images' => json_encode([0=>'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/cancha_sintetica_full_soccer2.jpg?alt=media&token=32c10113-bfe0-435e-93e3-3f3ee6f3a2fe',
                    1=>'https://firebasestorage.googleapis.com/v0/b/storageapi-2a0fd.appspot.com/o/cancha_sintetica_full_soccer.jpg?alt=media&token=2f7c77e0-939b-4a0a-b5ca-ccedc76ab013'],JSON_UNESCAPED_SLASHES)
            ],
            // Agrega más lugares según sea necesario
        ];

        // Iterar sobre el array de lugares y crear registros en la base de datos
        foreach ($lugares as $lugar) {
            Lugar::create([
                'nombre' => $lugar['nombre'],
                'descripcion' => $lugar['descripcion'],
                'url_images' => $lugar['url_images'],
            ]);
        }
    }
}
