<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManualMaintainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manual_maintains', function (Blueprint $table) {
            $table->id();

            $table->uuid('rkh_maintain_id');
            $table->foreign('rkh_maintain_id')->references('id')->on('rkh_maintains');

            $table->string('employee_name');
            $table->integer('circle');
            $table->integer('circle_coverage');
            $table->integer('pruning');
            $table->integer('pruning_coverage');
            $table->integer('gawangan');
            $table->time('maintain_date_start')->nullable();
            $table->time('maintain_date_end')->nullable();
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
        Schema::dropIfExists('manual_maintains');
    }
}
