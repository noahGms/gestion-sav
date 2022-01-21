<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            StateSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            ReturnSeeder::class,
            InterventionSeeder::class,
            DepotSeeder::class,
            UserSeeder::class,

            ItemSeeder::class
        ]);
    }
}
