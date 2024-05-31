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
            // Junio 1
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
