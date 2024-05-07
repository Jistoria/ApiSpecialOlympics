<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateUserDefault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

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
        $new_user = ['name'=>'Administrador',
                    'email'=>'admin_so@uleam.edu.ec',
                    'password'=>bcrypt('UleamFacci2024')];
        $AdminRole = Role::where('name', 'Administrador')->first();
        $user = new User();
        $user->fill($new_user);
        $user->save();

        $user->assignRole($AdminRole);
        $this->info("Se ha creado el usuario $user->name");
    }
}
