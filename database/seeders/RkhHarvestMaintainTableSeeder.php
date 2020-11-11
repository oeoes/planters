<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RkhHarvestMaintainTableSeeder extends Seeder
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
                'rkh_maintain_id'   => '3ede7405-5cdc-49a5-9556-9b3688e10721',
                'fertilizer_type'   => 'Fer1',
                'fertilizer_amount' => 100,
                'fertilizer_period' => 1
            ],            [
                'rkh_maintain_id'   => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'fertilizer_type'   => 'Fer1',
                'fertilizer_amount' => 120,
                'fertilizer_period' => 2
            ]
        ];
        DB::table('rkh_harvest_maintains')->insert($data);
    }
}
