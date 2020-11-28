<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $farms = [
            [
                'name' => 'farm1'
            ],
            [
                'name' => 'farm2'
            ],
            [
                'name' => 'farm3'
            ]
        ];
        DB::table('farms')->insert($farms);
    }
}
