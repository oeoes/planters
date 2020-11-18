<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarvestSprayingMaintainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvest_spraying', function (Blueprint $table) {
            $table->id();
            $table->uuid('rkh_maintain_id');
            $table->foreign('rkh_maintain_id')->references('id')->on('rkh_maintains')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained();
            $table->date('date');

            // Harvest Maintain
            $table->integer('harvest_amount');
            $table->float('harvest_coverage', 8, 2);
            $table->string('harvest_image')->nullable();

            // Spraying Maintain
            $table->integer('spraying_amount');
            $table->float('spraying_coverage', 8, 2);
            $table->string('spraying_image')->nullable();

            $table->time('maintain_time_start')->nullable();
            $table->time('maintain_time_end')->nullable();
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
        Schema::dropIfExists('harvest_spraying');
    }
}
