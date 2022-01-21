<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        require('data/auth_user.php');

        DB::table('users')->truncate();

        foreach ($auth_user as $user) {
            if ($user['id'] != 1) {
                DB::table('users')->insert([
                    'id' => $user['id'],
                    'is_admin' => (bool)$user['is_superuser'],
                    'username' => $user['username'],
                    'firstname' => $user['first_name'],
                    'lastname' => $user['last_name'],
                    'password' => ''
                ]);
            }
        }
    }
}
