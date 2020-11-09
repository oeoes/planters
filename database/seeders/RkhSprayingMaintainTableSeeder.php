<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RkhSprayingMaintainTableSeeder extends Seeder
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
                'spraying_type' => 'Spray1',
                'spraying_amount' => 100
            ],[
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'spraying_type' => 'Spray1',
                'spraying_amount' => 90
            ],
        ];
        DB::table('rkh_spraying_maintains')->insert($data);
    }
}
