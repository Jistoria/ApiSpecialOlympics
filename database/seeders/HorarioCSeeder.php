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
            [
                'horario' => 'Almuerzo día 1',
                'fecha' => '2024-05-15',
                'hora_inicio' => '12:00:00',
                'hora_fin' => '14:00:00'
            ],
            [
                'horario' => 'Almuerzo día 2',
                'fecha' => '2024-05-16',
                'hora_inicio' => '12:00:00',
                'hora_fin' => '14:00:00'
            ],
            [
                'horario' => 'Almuerzo día 3',
                'fecha' => '2024-05-17',
                'hora_inicio' => '12:00:00',
                'hora_fin' => '14:00:00'
            ],
        ];

        foreach ($horarios as $horario) {
            \App\Models\HorarioComida::create($horario);
        }
    }
}
