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
            $table->foreignId('foreman_id')->constrained('foremans');
            $table->foreignId('jobtype_id')->constrained('job_types');
            $table->char('planting_year');
            $table->float('total_coverage', 8, 2);
            $table->float('used_coverage');
            $table->float('population_coverage', 8, 2);
            $table->float('population_perblock', 8, 2);
            $table->char('completed')->default(0);
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
