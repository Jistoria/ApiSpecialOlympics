<?php

namespace App\Console\Commands;

use App\Models\Deportista;
use Illuminate\Console\Command;

class TestAtletasAl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:atletas-al';

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
        // Nombres y apellidos de los deportistas
        $deportistas = [
            ['nombre' => 'Ener', 'apellido' => 'Valencia'],
            ['nombre' => 'Messi', 'apellido' => ''],
            ['nombre' => 'LeBron', 'apellido' => 'James'],
            ['nombre' => 'Davor', 'apellido' => 'Shuque'],
            ['nombre' => 'Stella', 'apellido' => 'Marilis'],
        ];

        // ID de la provincia (puedes cambiar este valor según tus necesidades)
        $provinciaId = 1; // Por ejemplo, asumiendo que la provincia deseada tiene ID 1

        foreach ($deportistas as $deportistaData) {
            Deportista::create([
                'cedula' => rand(1000000, 9999999), // Genera un número aleatorio de cédula
                'numero_deportista' => rand(1000, 3000), // Número de deportista aleatorio
                'provincia_id' => $provinciaId,
                'nombre' => $deportistaData['nombre'],
                'apellido' => $deportistaData['apellido'],
                'edad' => rand(18, 40), // Edad aleatoria entre 18 y 40 años
                'genero' => rand(0, 1) ? 'M' : 'F', // Género aleatorio
                'url_imagen' => $deportistaData['nombre'].$deportistaData['nombre'].'.jpg', // URL de imagen de ejemplo
            ]);
        }

        $this->info('Se han creado 5 deportistas exitosamente.');
    }
}
