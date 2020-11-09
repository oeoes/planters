<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SprayingMaintainTableSeeder extends Seeder
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
                'employee_name'   => 'Dinda',
                'amount_used'     => 12,
                'coverage'        => 10,
            ],[
                'rkh_maintain_id' => '3ede7405-5cdc-49a5-9556-9b3688e10721',
                'employee_name'   => 'Alfin',
                'amount_used'     => 35,
                'coverage'        => 6,
            ],            [
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'employee_name'   => 'Dinda',
                'amount_used'     => 22,
                'coverage'        => 12,
            ],[
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'employee_name'   => 'Alfin',
                'amount_used'     => 20,
                'coverage'        => 15,
            ]
        ];
        DB::table('spraying_maintains')->insert($data);
    }
}
