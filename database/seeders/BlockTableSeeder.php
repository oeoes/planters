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
                'name' => 'Block AA',
                'afdelling_id' => 1,
            ],
            [
                'name' => 'Block BB',
                'afdelling_id' => 2,
            ],
            [
                'name' => 'Block CC',
                'afdelling_id' => 3,
            ],
            [
                'name' => 'Block DD',
                'afdelling_id' => 4,
            ]
            
        ];

        DB::table('blocks')->insert($blocks);
    }
}
