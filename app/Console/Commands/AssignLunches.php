<?php

namespace App\Console\Commands;

use App\Models\Almuerzo;
use App\Models\Deportista;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AssignLunches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:lunches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deportistas = Deportista::all();

        // Iterar sobre cada deportista y asignar un almuerzo para hoy
        $fechaActual = Carbon::today();

        foreach ($deportistas as $deportista) {
            $horaInicio = '12:00:00'; // Hora de inicio del almuerzo (ejemplo: 12:00 PM)
            $horaFin = '20:00:00'; // Hora de fin del almuerzo (ejemplo: 1:00 PM)

            // Crear un registro de almuerzo para el deportista y la fecha actual
            Almuerzo::create([
                'deportista_id' => $deportista->id,
                'fecha' => $fechaActual,
                'hora_inicio' => $horaInicio,
                'hora_fin' => $horaFin,
                'completado' => false,
            ]);

            // Mostrar información sobre el almuerzo asignado en la consola
            $this->info("Se asignó un almuerzo a {$deportista->nombre} {$deportista->apellido} para hoy.");
        }

        $this->info('Se han asignado almuerzos a todos los deportistas para realizar pruebas.');
    }
}
