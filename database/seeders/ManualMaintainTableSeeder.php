<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManualMaintainTableSeeder extends Seeder
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
                'rkh_maintain_id' => '3ede7405-5cdc-49a5-9556-9b3688e10721',
                'employee_id'   => 1,
                'circle' => 20,
                'circle_coverage' => 20,
                'pruning' => 15,
                'pruning_coverage' => 20,
                'gawangan' => 6
            ],[
                'rkh_maintain_id' => '3ede7405-5cdc-49a5-9556-9b3688e10721',
                'employee_id'   => 1,
                'circle' => 11,
                'circle_coverage' => 6,
                'pruning' => 20,
                'pruning_coverage' => 22,
                'gawangan' => 13
            ],            [
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'employee_id'   => 1,
                'circle' => 10,
                'circle_coverage' => 30,
                'pruning' => 6,
                'pruning_coverage' => 20,
                'gawangan' => 6
            ],[
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'employee_id'   => 1,
                'circle' => 10,
                'circle_coverage' => 12,
                'pruning' => 12,
                'pruning_coverage' => 2,
                'gawangan' => 20
            ]
        ];
        DB::table('manual_maintains')->insert($data);
    }
}
