<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Carga todos los datos por default en la base de datos.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cargando datos por defecto en la base de datos.');
        $this->call('migrate:fresh');
        $this->call('db:seed',['class'=>'ProvinciasSeeder']);
        $this->call('db:seed',['class'=>'DeportesSeeder']);
        $this->call('db:seed',['class'=>'ActividadesDeportivasSeeder']);
        $this->call('db:seed',['class'=>'LugaresSeeder']);
        $this->call('db:seed',['class'=>'TipoInvSeeder']);
        $this->call('roles:default');
        $this->call('create:admin');
        $this->call('create:roundsman');
        $this->info('Proceso completado.');
    }
}
