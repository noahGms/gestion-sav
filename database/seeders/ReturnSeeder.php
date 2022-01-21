<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/returns_return.php');

        DB::table('returns')->truncate();

        foreach($returns_return as $return) {
            DB::table('returns')->insert([
                'id' => $return['id'],
                'name' => $return['name']
            ]);
        }
    }
}
