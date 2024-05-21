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
            'OE. Azuay',
            'OE. Bolívar',
            'OE. Cañar',
            'OE. Carchi',
            'OE. Chimborazo',
            'OE. Cotopaxi',
            'OE. El Oro',
            'OE. Esmeraldas',
            'OE. Galápagos',
            'OE. Guayas',
            'OE. Imbabura',
            'OE. Loja',
            'OE. Los Ríos',
            'OE. Manabí',
            'OE. Morona Santiago',
            'OE. Napo',
            'OE. Orellana',
            'OE. Pastaza',
            'OE. Pichincha',
            'OE. Santa Elena',
            'OE. Santo Domingo de los Tsáchilas',
            'OE. Sucumbíos',
            'OE. Tungurahua',
            'OE. Zamora Chinchipe'


        ];

        // Iterar sobre el array de provincias y crear registros en la base de datos
        foreach ($provincias as $provincia) {
            Provincia::create([
                'provincia' => $provincia
            ]);
        }
    }
}
