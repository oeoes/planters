<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Spraying
        // 2. Pemupukan
        // 3. Manual (gausah di detailkan)
        // 4. Pengendalian hama&penyakit
        $jobs = [
            [
                'id'   => 1,
                'name' => 'Spraying'
            ],[
                'id'   => 2,
                'name' => 'Fertilizer'
            ],[
                'id'   => 3,
                'name' => 'Manual Circle'
            ],[
                'id'   => 4,
                'name' => 'Manual Pruning'
            ],[
                'id'   => 5,
                'name' => 'Manual Gawangan'
            ],[
                'id'   => 6,
                'name' => 'Pest Control'
            ],[
                'id'   => 7,
                'name' => 'Harvesting'
            ],
        ];

        DB::table('job_types')->insert($jobs);
    }
}
