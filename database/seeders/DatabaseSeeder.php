<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\TokenSeeder;
use Database\Seeders\BoxItemSeeder;
use Database\Seeders\DrawboxSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            DrawboxSeeder::class,
            TokenSeeder::class,
            BoxItemSeeder::class,
            UserSeeder::class,
        ]);
    }
}
