<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AfdellingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $afdellings = [
            [
                'name' => 'Afdelling1',
                'farm_id' => 1,
                'hk_total' => 20,
            ],
            [
                'name' => 'Afdelling2',
                'farm_id' => 1,
                'hk_total' => 20,
            ],
            [
                'name' => 'Afdelling3',
                'farm_id' => 2,
                'hk_total' => 20,
            ],
            [
                'name' => 'Afdelling4',
                'farm_id' => 3,
                'hk_total' => 20,
            ]
        ];

        DB::table('afdellings')->insert($afdellings);
    }
}
