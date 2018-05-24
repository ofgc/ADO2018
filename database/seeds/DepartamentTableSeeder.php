<?php

use Illuminate\Database\Seeder;
use App\Departament;

class DepartamentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departament = new Departament();
        $departament->name = 'informática';
        $departament->description = 'departamento de informática';
        $departament->save();

        $departament = new Departament();
        $departament->name = 'marketing';
        $departament->description = 'departamento de marketing';
        $departament->save();

    }
}
