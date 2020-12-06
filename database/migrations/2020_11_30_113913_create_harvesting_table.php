<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarvestingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harvestings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_ref_id')->constrained('block_references');
            $table->foreignId('foreman_id')->constrained('foremans');
            $table->foreignId('subforeman_id')->constrained('subforemans');
            $table->foreignId('afdelling_id')->constrained();
            $table->date('date');
            $table->float('target_coverage', 8, 2); // ls pnn
            $table->float('akp', 8, 2);
            $table->float('bjr', 8, 2);
            $table->decimal('taksasi', 12, 2);
            $table->float('basis', 8, 2);
            $table->integer('hk_used');
            $table->text('foreman_note')->nullable();
            $table->integer('completed')->default(0);
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
        Schema::dropIfExists('harvestings');
    }
}
