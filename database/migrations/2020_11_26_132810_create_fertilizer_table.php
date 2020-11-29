<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFertilizerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilizers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_ref_id')->constrained('block_references');
            $table->foreignId('foreman_id')->constrained('foremans');
            $table->foreignId('subforeman_id')->constrained('subforemans');
            $table->date('date');
            $table->string('type');
            $table->float('target_coverage', 8, 2);
            $table->float('ingredients_amount', 8, 2);           
            $table->integer('hk_used');
            $table->text('foreman_note')->nullable();
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
        Schema::dropIfExists('fertilizers');
    }
}
