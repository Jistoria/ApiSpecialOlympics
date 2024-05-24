<?php

namespace Database\Seeders;

use App\Models\TipoInvitado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoInvSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = [
            ['tipo_invitado' => 'Jefe de Delegación'],
            ['tipo_invitado' => 'Entrenador en Jefe'],
            ['tipo_invitado' => 'Asistente de Entrenador'],
            ['tipo_invitado' => 'Asistente Jefe de Delegación '],
            ['tipo_invitado' => 'VIP'],
            ['tipo_invitado' => 'Staff'],
            ['tipo_invitado' => 'Sistema'],
            ['tipo_invitado'=>'Prensa']
        ];
        foreach ($tipo as $t) {
            TipoInvitado::create([
                'tipo_invitado_nombre' => $t['tipo_invitado']
            ]);
        }
    }
}
