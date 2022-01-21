<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/depots_depot.php');

        DB::table('depots')->truncate();

        foreach ($depots_depot as $depot) {
            DB::table('depots')->insert([
                'id' => $depot['id'],
                'name' => $depot['name']
            ]);
        }
    }
}
