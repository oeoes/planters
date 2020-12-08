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
        $this->call([
            // FarmTableSeeder::class,
            // AfdellingTableSeeder::class,
            // BlockTableSeeder::class,
            // ForemanTableSeeder::class,
            JobTypeTableSeeder::class,
            // ManagerTableSeeder::class,
            SuperadminTableSeeder::class,
            // SubforemanTableSeeder::class,
            // SuperadminTableSeeder::class,
        ]);

        // Subforeman::factory(500)->create();
        // Foreman::factory(4)->create();
        // Assistant::factory(10)->create();

    }
}
