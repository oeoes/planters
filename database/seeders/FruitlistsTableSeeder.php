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
                'name' => 'sawit'
            ],
            [
                'name' => 'apel'
            ],

        ];
        DB::table('fruit_lists')->insert($data);
    }
}
