<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RkhManualMaintainTableSeeder extends Seeder
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
                'circle' => 100,
                'pruning' => 100,
                'gawangan' => 100,
            ],  [
                'rkh_maintain_id' => 'edd39e38-d07b-4b78-b689-43b1b66b5452',
                'circle' => 90,
                'pruning' => 90,
                'gawangan' => 110,
            ]
        ];
        DB::table('rkh_manual_maintains')->insert($data);
    }
}
