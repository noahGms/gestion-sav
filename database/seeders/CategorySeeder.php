<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/categories_category.php');

        DB::table('categories')->truncate();

        foreach ($categories_category as $category) {
            DB::table('categories')->insert([
                'id' => $category['id'],
                'name' => $category['name']
            ]);
        }
    }
}
