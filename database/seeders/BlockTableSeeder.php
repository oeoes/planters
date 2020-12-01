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
                'code' => 'AA',
                'afdelling_id' => 1,
            ],
            [
                'code' => 'BB',
                'afdelling_id' => 1,
            ],
            [
                'code' => 'CC',
                'afdelling_id' => 1,
            ],
            [
                'code' => 'DD',
                'afdelling_id' => 1,
            ],            [
                'code' => 'EE',
                'afdelling_id' => 1,
            ],            [
                'code' => 'FF',
                'afdelling_id' => 1,
            ],            [
                'code' => 'GG',
                'afdelling_id' => 1,
            ],            [
                'code' => 'HH',
                'afdelling_id' => 1,
            ]
            
        ];

        DB::table('blocks')->insert($blocks);
    }
}
