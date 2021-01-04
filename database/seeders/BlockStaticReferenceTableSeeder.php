<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockStaticReferenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [1, 1, 2015, 12, 0, 10, 120],
            [2, 1, 2016, 13, 0, 12, 156],
            [3, 1, 2017, 15, 0, 10, 150],
            [4, 1, 2018, 12, 0, 15, 180],
            [5, 1, 2019, 10, 0, 10, 100],
            [6, 1, 2020, 11, 0, 2, 22],
            [7, 1, 2019, 12, 0, 12, 144],
            [8, 1, 2018, 13, 0, 13, 169],
        ]; 

        foreach ($data as $value) {
            DB::table('block_static_references')->insert([
                'block_id' => $value[0],
                'afdelling_id' => $value[1],
                'planting_year' => $value[2],
                'total_coverage' => $value[3],
                'available_coverage' => $value[4],
                'population_coverage' => $value[5],
                'population_perblock' => $value[6],
            ]);
        }

    }
}
