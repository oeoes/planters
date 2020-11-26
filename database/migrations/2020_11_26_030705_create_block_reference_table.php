<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained();
            $table->char('planting_year');
            $table->float('block_coverage', 8, 2);
            $table->float('population_coverage', 8, 2);
            $table->float('population_perblock', 8, 2);
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
        Schema::dropIfExists('block_references');
    }
}
