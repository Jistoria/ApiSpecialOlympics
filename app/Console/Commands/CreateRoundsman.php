<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateRoundsman extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:roundsman';

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
        $new_roundsman = ['name'=>'Repartidor',
        'email'=>'voluntario@uleam.edu.ec',
        'password'=>bcrypt('SomosFacci')];
        $user = new User();
        $user->fill($new_roundsman);
        $user->save();
        $roundsmanRole = Role::where('name', 'Voluntario')->first();

        $user->assignRole($roundsmanRole);
    }
}
