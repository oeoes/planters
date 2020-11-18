<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFruitHarvestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fruit_harvesting', function (Blueprint $table) {
            $table->id();
            $table->uuid('rkh_harvesting_id');
            $table->foreign('rkh_harvesting_id')->references('id')->on('rkh_harvestings')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained();
            $table->date('date');
            $table->foreignId('fruit_id')->constrained('fruit_lists');
            $table->integer('harvest_target');
            $table->integer('harvest_amount');
            $table->integer('harvest_lines');
            $table->float('coverage_area', 8, 2);
            $table->string('report_image');
            $table->time('harvest_time_start')->nullable();
            $table->time('harvest_time_end')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fruit_harvesting');
    }
}
