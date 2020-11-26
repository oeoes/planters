<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockRefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $table->foreignId('block_id')->constrained();
        // $table->char('planting_year');
        // $table->float('block_coverage', 8, 2);
        // $table->float('population_coverage', 8, 2);
        // $table->float('population_perblock', 8, 2);
        $data = [
            'block_id' => 1,
            'planting_year' => '2015',
            'block_coverage' => 12,
            'population_coverage' => 10,
            'population_perblock' => 12*10
            
        ];

        DB::table('block_references')->insert($data);
    }
}
