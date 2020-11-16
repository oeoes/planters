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
            $table->foreign('rkh_maintain_id')->references('id')->on('rkh_maintains')->onDelete('cascade');;
            $table->foreignId('employee_id')->constrained();
            $table->integer('circle');
            $table->decimal('circle_coverage', 8, 2);
            $table->integer('pruning');
            $table->decimal('pruning_coverage', 8, 2);
            $table->integer('gawangan');
            $table->date('date');
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
        Schema::dropIfExists('manual_maintains');
    }
}
