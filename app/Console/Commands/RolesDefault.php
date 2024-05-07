<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
class RolesDefault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'roles:default';

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
        $roles = ['Administrador','Voluntario'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
            $this->info("El rol '$roleName' ha sido creado correctamente.");
        }
    }
}
