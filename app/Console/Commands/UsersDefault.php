<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class UsersDefault extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:users-default';

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
        $this->info('Creating default users Admin...');
        $usersA = [
            [
                'name' => 'Geovani',
                'email' => 'geovani_so@uleam.edu.ec',
                'password' => bcrypt('UleamFacci2024')
            ],
            [
                'name' => 'Administrador2',
                'email' => 'admin2_so@uleam.edu.ec',
                'password' => bcrypt('UleamFacci2024')
            ],
        ];
        $AdminRole = Role::where('name', 'Administrador')->first();
        foreach($usersA as $new_user) {
            $user = new User();
            $user->fill($new_user);
            $user->save();
            $user->assignRole($AdminRole);
            $this->info("Se ha creado el usuario $user->name");
        }
        $this->info("Se han creado los usuarios Administradores");

        $this->info('Creating default users Voluntario...');

        $usersV = [
            [
                'name' => 'Voluntario2',
                'email' => 'voluntario2@uleam.edu.ec',
                'password' => bcrypt('SomosFacci')
            ],
            [
                'name' => 'Voluntario3',
                'email' => 'voluntario3@uleam.edu.ec',
                'password' => bcrypt('SomosFacci')
            ],
            [
                'name' => 'Voluntario4',
                'email' => 'voluntario4@uleam.edu.ec',
                'password' => bcrypt('SomosFacci')
            ],
            [
                'name' => 'Voluntario5',
                'email' => 'voluntario5@uleam.edu.ec',
                'password' => bcrypt('SomosFacci')
            ],
        ];
        $VoluntarioRole = Role::where('name', 'Voluntario')->first();
        foreach($usersV as $new_user) {
            $user = new User();
            $user->fill($new_user);
            $user->save();
            $user->assignRole($VoluntarioRole);
            $this->info("Se ha creado el usuario $user->name");
        }
    }
}
