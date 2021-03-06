<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Departament;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $departament_info = Departament::where('name', 'informática')->first();
        $departament_mark = Departament::where('name', 'marketing')->first();
        $user = new User();
        $user->name = 'User';
        $user->username='user';
        $user->email = 'user@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_user);
        $user->departaments()->attach($departament_info);

        $user = new User();
        $user->name = 'Admin';
        $user->username='admin';
        $user->email = 'admin@example.com';
        $user->password = bcrypt('secret');
        $user->save();
        $user->roles()->attach($role_admin);
        $user->departaments()->attach($departament_mark);

        for($a = 1; $a<=30; $a++){
            $user = new User();
            $user->username = 'Usuario'.$a;
            $user->name = 'Usuario'.$a;
            $user->email = 'usuario'.$a.'@example.com';
            $user->password = bcrypt('secret');
            $user->save();
            $user->roles()->attach($role_user);
            $user->departaments()->attach($departament_mark);
        }
    }
}
