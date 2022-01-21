<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/interventions_intervention.php');

        DB::table('interventions')->truncate();

        foreach ($interventions_intervention as $intervention) {
            DB::table('interventions')->insert([
                'id' => $intervention['id'],
                'name' => $intervention['name']
            ]);
        }
    }
}
