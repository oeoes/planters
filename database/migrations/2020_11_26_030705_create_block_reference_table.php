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
            $table->foreignId('block_id')->constrained('blocks');
            $table->foreignId('foreman_id')->constrained('foremans');
            $table->foreignId('jobtype_id')->constrained('job_types');
            $table->char('planting_year')->nullable();
            $table->double('total_coverage', 8, 2);
            $table->double('available_coverage', 8, 2);
            $table->double('population_coverage', 8, 2); // SPH
            $table->double('population_perblock', 8, 2); // Total coverage *
            $table->string('model')->nullable();
            $table->string('fill')->nullable();
            $table->string('fill_id')->nullable();
            $table->char('completed')->default(0);
            $table->timestamps();

            // $table->id();
            // $table->foreignId('block_id')->constrained('blocks');
            // $table->foreignId('foreman_id')->constrained('foremans');
            // $table->foreignId('jobtype_id')->constrained('job_types');
            // $table->integer('iterate');
            // $table->char('planting_year')->nullable();
            // $table->double('total_coverage', 8, 2);
            // $table->double('available_coverage', 8, 2);
            // $table->string('model')->nullable();
            // $table->string('fill')->nullable();
            // $table->string('fill_id')->nullable();
            // $table->char('completed')->default(0);
            // $table->timestamps();
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
