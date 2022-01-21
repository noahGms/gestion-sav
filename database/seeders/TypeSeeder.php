<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/machinestypes_type.php');
        require('data/categories_category.php');

        DB::table('types')->truncate();

        foreach ($machinestypes_type as $type) {
            $category = array_filter($categories_category, function ($category) use ($type) {
                return $category['id'] === $type['category_id'];
            });
            $category = array_shift($category);

            DB::table('types')->insert([
                'id' => $type['id'],
                'name' => $type['name'],
                'category_id' => $category['id']
            ]);
        }
    }
}
