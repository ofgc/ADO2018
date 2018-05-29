<?php

use Illuminate\Database\Seeder;

use App\Description;

class DescriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $description = new Description();
        $description->name = 'marketing';
        $description->description = 'Presupuesto destinado a operaciones de marketing';
        $description->save();

        $description = new Description();
        $description->name = 'informatica';
        $description->description = 'Presupuesto destinado a operaciones de informatica';
        $description->save();
    }
}
