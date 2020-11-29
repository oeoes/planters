<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AfdellingRefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'afdelling_id' => 1,
            'available_hk' => 100,
            'available_date' => '2015/08/18',
        ];
        DB::table('afdelling_references')->insert($data);
    }
}
