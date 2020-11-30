<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillHarvestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fill_harvestings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('harvest_id')->constrained('harvestings');
            $table->float('ftarget_coverage', 8, 2);
            $table->float('ftarget_akp', 8, 2);
            $table->float('ftarget_bjr', 8, 2);
            $table->string('image')->nullable();
            $table->text('hk_name');
            $table->text('subforeman_note')->nullable();
            $table->time('begin');
            $table->time('ended');
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
        Schema::dropIfExists('fill_harvesting');
    }
}
