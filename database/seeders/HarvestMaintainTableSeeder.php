<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HarvestMaintainTableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'rkh_maintain_id' => '3ede7405-5cdc-49a5-9556-9b3688e10721',
                'employee_id'   => 1,
                'amount_used'     => 10,
                'coverage'        => 12,
            ],[
                'rkh_maintain_id' => '3ede7405-5cdc-49a5-9556-9b3688e10721',
                'employee_id'   => 1,
                'amount_used'     => 15,
                'coverage'        => 45,
            ],            [
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'employee_id'   => 1,
                'amount_used'     => 20,
                'coverage'        => 10,
            ],[
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'employee_id'   => 1,
                'amount_used'     => 30,
                'coverage'        => 15,
            ]
        ];
        DB::table('harvest_maintains')->insert($data);
    }
}
