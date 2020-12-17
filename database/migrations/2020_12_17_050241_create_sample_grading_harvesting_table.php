<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSampleGradingHarvestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sample_grading_harvestings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('afdelling_id')->constrained('afdellings');
            $table->foreignId('block_reference_id')->constrained('block_references');
            $table->foreignId('block_id')->constrained('blocks');
            $table->char('planting_year')->nullable();
            $table->date('expired_at');
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
        Schema::dropIfExists('sample_grading_harvestings');
    }
}
