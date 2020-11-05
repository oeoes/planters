<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maintain\RkhMaintain;
use Ramsey\Uuid\Uuid;

class RkhMaintainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* 
            area
            md1
            md2
            coverage
            population
            planting_date
            employees_number
        */
        RkhMaintain::insert([
            'id' => '7dd6355f-4827-4a1c-b49f-0600c20e1fc4',
            'area_id' => 1,
            'foreman1_id'  => 1,
            'foreman2_id'  => 1,
            'coverage' => 200,
            'population' => 1000,
            'planting_date' => date('Y-m-d'),
            'employees_number' => 10,
        ],[
            'id' => 'af0ddd6c-c7bc-4f24-b061-e5e591f0a974',
            'area_id' => 1,
            'foreman1_id'  => 1,
            'foreman2_id'  => 1,
            'coverage' => 300,
            'population' => 500,
            'planting_date' => date('Y-m-d'),
            'employees_number' => 20, 
        ]);
    }
}
