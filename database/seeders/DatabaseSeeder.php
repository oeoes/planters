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
        // \App\Models\User::factory(10)->create();
        \App\Models\Assistant::factory(5)->create();
        // \App\Models\Foreman1::factory(5)->create();
        // \App\Models\Foreman2::factory(5)->create();
        // \App\Models\Farm::factory(3)->create();
        // \App\Models\Afdelling::factory(15)->create();
        // \App\Models\Block::factory(30)->create();
        // \App\Models\Area::factory(3)->create();

        $this->call([
            AssistantTableSeeder::class,
            FarmTableSeeder::class,
            AfdellingTableSeeder::class,
            BlockTableSeeder::class,
            AreaTableSeeder::class,
            Foreman1TableSeeder::class,
            Foreman2TableSeeder::class,
            RkhMaintainTableSeeder::class,
            RkhHarvestMaintainTableSeeder::class,
            HarvestMaintainTableSeeder::class
        ]);
    }
}
