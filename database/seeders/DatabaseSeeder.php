<?php

namespace Database\Seeders;

use App\Models\Afdelling;
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
        
        $this->call([
            AssistantTableSeeder::class,
            FarmTableSeeder::class,
            AfdellingTableSeeder::class,

            BlockTableSeeder::class,
            ForemanTableSeeder::class,
            SubforemanTableSeeder::class,
            
            AfdellingRefTableSeeder::class,
            BlockRefTableSeeder::class,
            JobTypeTableSeeder::class
        ]);
    }
}
