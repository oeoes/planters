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
            $table->uuid('rkh_maintain_id');
            $table->foreign('rkh_maintain_id')->references('id')->on('rkh_maintains')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained();
            $table->date('date');
            $table->foreignId('fruit_list_id')->constrained('fruit_lists');
            $table->integer('harvest_target');
            $table->integer('harvest_amount');
            $table->integer('harvest_lines');
            $table->float('coverage_area', 8, 2);
            $table->string('report_image');
            $table->time('harvest_time_start')->nullable();
            $table->time('harvest_time_end')->nullable();
            $table->float('lat', 10, 8)->nullable();
            $table->float('lng', 11, 8)->nullable();
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
