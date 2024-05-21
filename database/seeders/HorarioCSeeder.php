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
                'horario' => 'Mayo 21',
                'fecha' => '2024-05-21',
            ],
            [
                'horario' => 'Junio 2',
                'fecha' => '2024-06-02',
            ],
            [
                'horario' => 'Junio 3',
                'fecha' => '2024-06-03',
            ],
            [
                'horario' => 'Junio 4',
                'fecha' => '2024-06-04',
            ],
        ];

        foreach ($horarios as $horario) {
            \App\Models\HorarioComida::create($horario);
        }
    }
}
