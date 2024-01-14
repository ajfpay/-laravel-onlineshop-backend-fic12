<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //category
        \App\Models\Category::factory(4)->create();
        //product
        \App\Models\Product::factory(20)->create();

        $this->call([
            UserSeeder::class,
        ]);
    }
}
