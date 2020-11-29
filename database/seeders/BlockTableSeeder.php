<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blocks = [
            [
                'code' => 'Block AA',
                'afdelling_id' => 1,
            ],
            [
                'code' => 'Block BB',
                'afdelling_id' => 1,
            ],
            [
                'code' => 'Block CC',
                'afdelling_id' => 1,
            ],
            [
                'code' => 'Block DD',
                'afdelling_id' => 1,
            ]
            
        ];

        DB::table('blocks')->insert($blocks);
    }
}
