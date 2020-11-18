<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRkhHarvestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkh_harvestings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('farm_id')->constrained();
            $table->foreignId('afdelling_id')->constrained();
            $table->foreignId('block_id')->constrained();
            $table->foreignId('foreman1_id')->constrained('foremans1');
            $table->foreignId('foreman2_id')->constrained('foremans2');
            $table->integer('coverage');
            $table->integer('population');
            $table->date('date');
            $table->float('akp', 8, 2);
            $table->float('bjr', 8, 2);
            $table->integer('employees_number');
            $table->char('active')->default(1); 
            // 1 for opened, 0 for closed
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
        Schema::dropIfExists('rkh_harvestings');
    }
}
