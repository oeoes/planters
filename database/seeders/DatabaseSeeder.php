<?php

namespace Database\Seeders;

use App\Models\Assistant;
use App\Models\Foreman;;
use App\Models\Subforeman;
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
        Assistant::factory(10)->create();
        
        $this->call([
            AssistantTableSeeder::class,
            FarmTableSeeder::class,
            AfdellingTableSeeder::class,
            BlockTableSeeder::class,
            ForemanTableSeeder::class,
            // AfdellingRefTableSeeder::class,
            JobTypeTableSeeder::class,
            SubforemanTableSeeder::class,
            // BlockRefTableSeeder::class,
        ]);

        Subforeman::factory(50)->create();
        Foreman::factory(50)->create();

    }
}
