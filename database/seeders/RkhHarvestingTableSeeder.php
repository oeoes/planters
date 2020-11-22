<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RkhHarvestingTableSeeder extends Seeder
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
                'id' => '3ede7405-5cdc-49a5-9556-9b3688e10721',
                'area_id' => 1,
                'farm_id' => 1,
                'afdelling_id'=> 1,
                'block_id'    => 1,
                'foreman1_id' => 1,
                'foreman2_id' => 2,
                'coverage'    => 100,
                'population'  => 50,
                'date' => '2019-11-19',
                'akp' => 1,
                'bjr' => 1,
                'active' => 0,
                'employees_number' => 100
            ],[
                'id' => 'popi7405-5cdc-49a5-9556-9b3688e55555',
                'area_id' => 1,
                'farm_id' => 1,
                'afdelling_id'=> 1,
                'block_id'    => 1,
                'foreman1_id' => 1,
                'foreman2_id' => 2,
                'coverage'    => 100,
                'population'  => 50,
                'date' => '2019-11-19',
                'akp' => 1,
                'bjr' => 1,
                'active' => 0,
                'employees_number' => 100
            ]
        ];

        DB::table('rkh_harvestings')->insert($data);
    }
}
