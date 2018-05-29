<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->level = '1';
        $role->save();

        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->level = '5';
        $role->save();
    }
}
