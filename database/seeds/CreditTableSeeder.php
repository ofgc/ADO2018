<?php

use Illuminate\Database\Seeder;

use App\Credit;
use App\Description;

class CreditTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$description_marketing = Description::where('name', 'marketing')->first();
        $description_informatica = Description::where('name', 'informatica')->first();

        $credit = new Credit();
        $credit->year = '2018';
        $credit->initial_credit = '2000';
        $credit->description_id="1";
        $credit->save();

        $credit = new Credit();
        $credit->year = '2017';
        $credit->initial_credit = '4000';
        $credit->description_id="2";
        $credit->save();

    }
}
