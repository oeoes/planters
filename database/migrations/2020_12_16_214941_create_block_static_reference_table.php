<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockStaticReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_static_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained();
            $table->foreignId('afdelling_id')->constrained('afdellings');
            $table->char('planting_year')->nullable();
            $table->double('total_coverage', 8, 2);
            $table->double('available_coverage', 8, 2);
            $table->double('population_coverage', 8, 2); // SPH
            $table->double('population_perblock', 8, 2); // Total coverage *
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
        Schema::dropIfExists('block_static_references');
    }
}
