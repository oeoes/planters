<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfdellingReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afdelling_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foreman_id')->constrained('foremans');
            $table->foreignId('afdelling_id')->constrained();
            $table->integer('hk_total');
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
        Schema::dropIfExists('alfdelling_references');
    }
}
