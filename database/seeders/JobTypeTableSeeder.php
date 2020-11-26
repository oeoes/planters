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
                'name' => 'Spraying'
            ],[
                'name' => 'Fertilizer'
            ],[
                'name' => 'Manual'
            ],[
                'name' => 'Pest Control'
            ],
        ];

        DB::table('job_types')->insert($jobs);
    }
}
