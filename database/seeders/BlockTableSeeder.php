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
                'lat' => -6.5901421706647465,
                'lng' => 106.85604873649649
            ],
            [
                'code' => 'BB',
                'afdelling_id' => 1,
                'lat' => -6.5901421706647465,
                'lng' => 106.84604873649649
            ],
            [
                'code' => 'CC',
                'afdelling_id' => 1,
                'lat' => -6.5901421706647465,
                'lng' => 106.83604873649649
            ],
            [
                'code' => 'DD',
                'afdelling_id' => 1,
                'lat' => -6.5901421706647465,
                'lng' => 106.82604873649649
            ],            [
                'code' => 'EE',
                'afdelling_id' => 1,
                'lat' => -6.5901421706647465,
                'lng' => 106.81604873649649
            ],            [
                'code' => 'FF',
                'afdelling_id' => 1,
                'lat' => -6.5901421706647465,
                'lng' => 106.79604873649649
            ],            [
                'code' => 'GG',
                'afdelling_id' => 1,
                'lat' => -6.5901421706647465,
                'lng' => 106.78604873649649
            ],            [
                'code' => 'HH',
                'afdelling_id' => 1,
                'lat' => -6.5901421706647465,
                'lng' => 106.77604873649649
            ]
            
        ];

        DB::table('blocks')->insert($blocks);
    }
}
