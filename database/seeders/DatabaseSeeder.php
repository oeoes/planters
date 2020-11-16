<?php

namespace Database\Seeders;

use App\Models\HarvestMaintain;
use App\Models\RkhMaintain;
use App\Models\SprayingMaintain;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // https://stackoverflow.com/questions/42639976/laravel-seeding-results-in-null-timestamp
    public function run()
    {
        \App\Models\Assistant::factory(10)->create();
        \App\Models\Farm::factory(5)->create();
        \App\Models\Afdelling::factory(10)->create();
        \App\Models\Block::factory(15)->create();
        \App\Models\Foreman1::factory(2)->create();
        \App\Models\Foreman2::factory(2)->create();
        \App\Models\Employee::factory(10)->create();

        $this->call([
            AreaTableSeeder::class,
            AssistantTableSeeder::class,
            RkhMaintainTableSeeder::class,
            RkhManualMaintainTableSeeder::class,
            RkhHarvestMaintainTableSeeder::class,
            RkhSprayingMaintainTableSeeder::class,
            HarvestMaintainTableSeeder::class,
            SprayingMaintainTableSeeder::class,
            ManualMaintainTableSeeder::class,
            Foreman1TableSeeder::class,
            Foreman2TableSeeder::class
        ]);
    }
}
