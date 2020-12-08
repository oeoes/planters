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
            $table->foreignId('afdelling_id')->constrained();
            $table->float('ftarget_coverage', 8, 2); // hasil panen aktual , total panen
            $table->float('bjr', 8, 2);
            $table->integer('total_harvesting'); // list dari nama karyawan dan total_harvesting
            $table->float('final_harvesting', 8, 2); // total
            $table->string('image')->nullable();
            $table->text('subforeman_note')->nullable();
            $table->time('begin');
            $table->time('ended');
            $table->integer('completed')->default(1);
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
