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
            'foreman_id' => 1,
            'afdelling_id' => 1,
            'hk_total' => 100
        ];
        DB::table('afdelling_references')->insert($data);
    }
}
