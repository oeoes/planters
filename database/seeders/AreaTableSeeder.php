<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seeds = [
            [1, 1, 1],
            [1, 1, 2],
            [1, 2, 3],
            [1, 2, 4],
            [2, 3, 5],
            [2, 3, 6],
            [2, 4, 7],
            [2, 4, 8]
        ];
        foreach ($seeds as $key => $val) {
                DB::table('areas')->insert([
                    'farm_id' => $seeds[$key][0],
                    'afdelling_id' => $seeds[$key][1],
                    'block_id' => $seeds[$key][2]
                ]);
        }
        
    }
}
