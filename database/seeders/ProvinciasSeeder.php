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
            'OE. AZUAY',
            'OE. BOLIVAR',
            'OE. CAÑAR',
            'OE. CARCHI',
            'OE. COTOPAXI',
            'OE. CHIMBORAZO',
            'OE. EL ORO',
            'OE. ESMERALDAS',
            'OE. GALAPAGOS',
            'OE. GUAYAS',
            'OE. IMBABURA',
            'OE. LOJA',
            'OE. LOS RIOS',
            'OE. MANABI',
            'OE. MORONA SANTIAGO',
            'OE. NAPO',
            'OE. PASTAZA',
            'OE. PICHINCHA',
            'OE. SANTA ELENA',
            'OE. SANTO DOMINGO DE LOS TSACHILAS',
            'OE. SUCUMBIOS',
            'OE. TUNGURAHUA',
            'OE. ZAMORA CHINCHIPE'
        ];

        // Iterar sobre el array de provincias y crear registros en la base de datos
        foreach ($provincias as $provincia) {
            Provincia::create([
                'provincia' => $provincia
            ]);
        }
    }
}
