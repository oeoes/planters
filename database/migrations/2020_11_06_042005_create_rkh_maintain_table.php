<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRkhMaintainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkh_maintains', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('area_id')->constrained();
            $table->foreignId('farm_id')->constrained();
            $table->foreignId('afdelling_id')->constrained();
            $table->foreignId('block_id')->constrained();
            $table->foreignId('foreman1_id')->constrained('foremans1');
            $table->foreignId('foreman2_id')->constrained('foremans2');
            $table->float('coverage', 8, 2);
            $table->integer('population');
            $table->integer('period');
            $table->date('date');
            $table->char('planting_year');

            // Fertilizer mode
            $table->string('fertilizer_type');
            $table->integer('fertilizer_amount');
            $table->enum('fertilizer_period', [1, 2]);

            // Spraying mode
            $table->string('spraying_type');
            $table->integer('spraying_amount');

            // Manual mode
            $table->integer('manual_circle');
            $table->integer('manual_pruning');
            $table->integer('manual_gawangan');

            $table->integer('employees_number');
            $table->char('active')->default(1); // 1 for opened, 2 for closed
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
        Schema::dropIfExists('rkh_maintains');
    }
}
