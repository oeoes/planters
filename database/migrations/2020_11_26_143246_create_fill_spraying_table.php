<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillSprayingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fill_sprayings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spraying_id')->constrained();
            $table->float('ftarget_coverage', 8, 2);
            $table->float('fingredients_amount', 8, 2);
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
        Schema::dropIfExists('fill_sprayings');
    }
}
