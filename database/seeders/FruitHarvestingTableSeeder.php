<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FruitHarvestingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // $table->uuid('rkh_harvesting_id');
        // $table->foreign('rkh_harvesting_id')->references('id')->on('rkh_harvestings')->onDelete('cascade');
        // $table->foreignId('employee_id')->constrained();
        // $table->foreignId('fruit_id')->constrained('fruit_lists');
        // $table->integer('harvest_target');
        // $table->integer('harvest_amount');
        // $table->integer('harvest_lines');
        // $table->float('coverage_area', 8, 2);
        // $table->string('report_image');
        // $table->time('time_start')->nullable();
        // $table->time('time_end')->nullable();
        // $table->decimal('lat', 10, 8)->nullable();
        // $table->decimal('lng', 11, 8)->nullable();

        $data = [
            [
                'rkh_harvesting_id' => 'popi7405-5cdc-49a5-9556-9b3688e55555',
                'employee_id' => 1,
                'fruit_id' => 1,
                'harvest_target' => 100,
                'harvest_amount' => 50,
                'harvest_lines' => 12,
                'coverage_area' => 12,
                'report_image' => 'xxxx/jpg',
                'time_start' => '10:00',
                'time_end' => '15:30'
            ],[
                'rkh_harvesting_id' => 'popi7405-5cdc-49a5-9556-9b3688e55555',
                'employee_id' => 2,
                'fruit_id' => 1,
                'harvest_target' => 200,
                'harvest_amount' => 100,
                'harvest_lines' => 40,
                'coverage_area' => 20,
                'report_image' => 'xxxdx/jpg',
                'time_start' => '09:00',
                'time_end' => '12:30'
            ]
            
        ];

        DB::table('fruit_harvesting')->insert($data);
    }
}
