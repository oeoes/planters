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
            'foreman_id' => 1,
            'planting_year' => '2015',
            'total_coverage' => 100,
            'used_coverage' => 0,
            'population_coverage' => 100,
            'population_perblock' => 100 / 12,
            'jobtype_id' => 1,
        ];

        DB::table('block_references')->insert($data);
    }
}
