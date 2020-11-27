<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFillPcontrolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fill_pcontrols', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fertilizer_id')->constrained();
            $table->float('expectation', 9, 2);
            $table->string('image_url');
            $table->string('fill_qty');
            $table->json('hk_name');
            $table->text('subforeman_note')->nullable();
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
        Schema::dropIfExists('pest_controls');
    }
}
