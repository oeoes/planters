<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitlistsTableSeeder extends Seeder
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
                'farm_id' => 1,
                'name' => 'sawit'
            ],[
                'farm_id' => 2,
                'name' => 'apel'
            ],[
                'farm_id' => 3,
                'name' => 'Mangga'
            ],[
                'farm_id' => 4,
                'name' => 'Markisa'
            ]

        ];
        DB::table('fruit_lists')->insert($data);
    }
}
