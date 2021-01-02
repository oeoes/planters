<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSamplingGradingHarvestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sampling_grading_harvestings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_grading_id')->constrained('sample_grading_harvestings')->cascadeOnDelete();
            $table->foreignId('grading_harvesting_id')->constrained('grading_harvestings')->cascadeOnDelete();
            $table->foreignId('block_reference_id')->constrained('block_references');
            $table->foreignId('block_id')->constrained('blocks');
            $table->char('planting_year')->nullable();
            $table->string('hk_name');
            $table->date('date');
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
        Schema::dropIfExists('sampling_grading_harvestings');
    }
}
