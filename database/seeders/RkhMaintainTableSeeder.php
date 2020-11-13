<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class RkhMaintainTableSeeder extends Seeder
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
            'foreman1_id' => 1,
            'foreman2_id' => 2,
            'coverage' => 1000,
            'population' => 100,
            'planting_year' => '2010',
            'employees_number' => 20,
            'status' => 1 //active
          ],[
            'id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
            'area_id' => 1,
            'foreman1_id' => 1,
            'foreman2_id' => 2,
            'coverage' => 2000,
            'population' => 200,
            'planting_year' => '2010',
            'employees_number' => 40,
            'status' => 1 //active
          ],
        ];
        DB::table('rkh_maintains')->insert($data);
    }
}
