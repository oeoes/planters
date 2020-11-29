<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillPcontrolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fill_pcontrols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pcontrol_id')->constrained('pest_controls');
            $table->float('expec_ingredients_coverage', 9, 2);
            $table->integer('expec_ingredients_amount');
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
        Schema::dropIfExists('pest_controls');
    }
}
