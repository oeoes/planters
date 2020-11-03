<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawatManualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_manual', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rkh_id')->constrained('rkh');
            $table->string('karyawan');
            $table->integer('circle');
            $table->integer('luas_circle');
            $table->integer('pruning');
            $table->integer('luas_pruning');
            $table->integer('gawangan');
            $table->time('jam_mulai_rawat')->nullable();
            $table->time('jam_selesai_rawat')->nullable();
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
        Schema::dropIfExists('rawat_manual');
    }
}
