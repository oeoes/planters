<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Farm;
use App\Models\Afdelling;
use App\Models\Block;
use App\Models\Area;

class AreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'farm_id' => 1,
                'afdelling_id' => 1,
                'block_id' => 1
            ], [
                'farm_id' => 2,
                'afdelling_id' => 2,
                'block_id' => 2
            ], [
                'farm_id' => 3,
                'afdelling_id' => 3,
                'block_id' => 3
            ]
            ];
        Area::insert($data);
    }
}
