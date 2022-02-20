<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
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
        Schema::enableForeignKeyConstraints();
    }
}
