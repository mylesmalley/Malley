<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserAndLabourSeeder;
use Database\Seeders\RolesSeeder;

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
            RolesSeeder::class,
            UserAndLabourSeeder::class,
        ]);
    }
}
