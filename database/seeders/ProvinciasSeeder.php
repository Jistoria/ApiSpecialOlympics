<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Array con nombres de las provincias del Ecuador
        $provincias = [
            'Azuay',
            'Bolívar',
            'Cañar',
            'Carchi',
            'Chimborazo',
            'Cotopaxi',
            'El Oro',
            'Esmeraldas',
            'Galápagos',
            'Guayas',
            'Imbabura',
            'Loja',
            'Los Ríos',
            'Manabí',
            'Morona Santiago',
            'Napo',
            'Orellana',
            'Pastaza',
            'Pichincha',
            'Santa Elena',
            'Santo Domingo de los Tsáchilas',
            'Sucumbíos',
            'Tungurahua',
            'Zamora-Chinchipe'
        ];

        // Iterar sobre el array de provincias y crear registros en la base de datos
        foreach ($provincias as $provincia) {
            Provincia::create([
                'provincia' => $provincia
            ]);
        }
    }
}
