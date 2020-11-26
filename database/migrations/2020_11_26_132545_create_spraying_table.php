<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprayingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprayings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_ref_id')->constrained('block_references');
            $table->date('date');
            $table->foreignId('subforeman_id')->constrained('subforemans');
            $table->string('type');
            $table->string('materials');
            $table->float('target, 8, 2');
            $table->integer('hk_used');
            $table->text('foreman_note')->nullable();
            $table->char('completed');
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
        Schema::dropIfExists('sprayings');
    }
}
