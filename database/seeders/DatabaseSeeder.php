<?php

namespace Database\Seeders;

use Database\Seeders\RolesSeeder;
use Database\Seeders\UserAndLabourSeeder;
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
            RolesSeeder::class,
            UserAndLabourSeeder::class,
        ]);
    }
}
