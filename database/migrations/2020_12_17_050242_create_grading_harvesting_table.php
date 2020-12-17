<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradingHarvestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grading_harvestings', function (Blueprint $table) {
            $table->id();
            $table->foreignId(('sample_grading_id'))->constrained('sample_grading_harvestings')->cascadeOnDelete();
            $table->foreignId('afdelling_id')->constrained('afdellings');
            $table->date('date');
            $table->string('hk_name');
            $table->integer('harvesting_bunch');
            $table->integer('unharvesting_bunch');
            $table->integer('bunch_leaves');
            $table->integer('in_circle');
            $table->integer('out_circle');
            $table->integer('on_palm');
            $table->integer('harvesting_path');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('grading_harvestings');
    }
}
