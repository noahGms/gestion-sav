<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/brands_brand.php');

        DB::table('brands')->truncate();

        foreach ($brands_brand as $brand) {
            DB::table('brands')->insert([
                'id' => $brand['id'],
                'name' => $brand['name']
            ]);
        }
    }
}
