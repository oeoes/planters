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
            $table->foreignId('foreman1_id')->constrained('foremans1');
            $table->foreignId('foreman2_id')->constrained('foremans2');
            $table->integer('coverage');
            $table->integer('population');
            $table->date('planting_date');
            $table->integer('employees_number');
            $table->char('status')->default(1); // 1 for opened, 2 for closed
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
