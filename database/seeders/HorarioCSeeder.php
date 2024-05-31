<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HorarioCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horarios = [
            //Mayo 30
            // [
            //     'horario' => 'Mayo 30 Desayuno',
            //     'fecha' => '2024-05-30',
            //     'hora_inicio' => '22:30',
            //     'hora_fin' => '22:40',
            // ],
            // [
            //     'horario' => 'Mayo 30 Almuerzo',
            //     'fecha' => '2024-05-30',
            //     'hora_inicio' => '22:40',
            //     'hora_fin' => '22:50',
            // ],
            // [
            //     'horario' => 'Mayo 30 Merienda',
            //     'fecha' => '2024-05-30',
            //     'hora_inicio' => '23:00',
            //     'hora_fin' => '23:10',
            // ],
            //Junio 1
            [
                'horario' => 'Junio 1 Desayuno',
                'fecha' => '2024-06-01',
                'hora_inicio' => '05:00',
                'hora_fin' => '10:00',
            ],
            [
                'horario' => 'Junio 1 Almuerzo',
                'fecha' => '2024-06-01',
                'hora_inicio' => '12:00',
                'hora_fin' => '16:00',
            ],
            [
                'horario' => 'Junio 1 Merienda',
                'fecha' => '2024-06-01',
                'hora_inicio' => '17:00',
                'hora_fin' => '20:00',
            ],
            // Junio 2
            [
                'horario' => 'Junio 2 Desayuno',
                'fecha' => '2024-06-02',
                'hora_inicio' => '05:00',
                'hora_fin' => '10:00',
            ],
            [
                'horario' => 'Junio 2 Almuerzo',
                'fecha' => '2024-06-02',
                'hora_inicio' => '12:00',
                'hora_fin' => '16:00',
            ],
            [
                'horario' => 'Junio 2 Merienda',
                'fecha' => '2024-06-02',
                'hora_inicio' => '17:00',
                'hora_fin' => '20:00',
            ],
            // Junio 3
            [
                'horario' => 'Junio 3 Desayuno',
                'fecha' => '2024-06-03',
                'hora_inicio' => '05:00',
                'hora_fin' => '10:00',
            ],
            [
                'horario' => 'Junio 3 Almuerzo',
                'fecha' => '2024-06-03',
                'hora_inicio' => '12:00',
                'hora_fin' => '16:00',
            ],
            [
                'horario' => 'Junio 3 Merienda',
                'fecha' => '2024-06-03',
                'hora_inicio' => '17:00',
                'hora_fin' => '20:00',
            ],
            // Junio 4
            [
                'horario' => 'Junio 4 Desayuno',
                'fecha' => '2024-06-04',
                'hora_inicio' => '05:00',
                'hora_fin' => '10:00',
            ],
            [
                'horario' => 'Junio 4 Almuerzo',
                'fecha' => '2024-06-04',
                'hora_inicio' => '12:00',
                'hora_fin' => '16:00',
            ],
            [
                'horario' => 'Junio 4 Merienda',
                'fecha' => '2024-06-04',
                'hora_inicio' => '17:00',
                'hora_fin' => '20:00',
            ],
        ];

        foreach ($horarios as $horario) {
            \App\Models\HorarioComida::create($horario);
        }
    }
}
