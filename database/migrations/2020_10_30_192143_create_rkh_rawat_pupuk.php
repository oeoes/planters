<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRkhRawatPupuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkh_rawat_pupuk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rkh_id')->constrained('rkh');
            $table->string('jenis_pupuk');
            $table->integer('jml_pupuk');
            $table->char('periode_pupuk');
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
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
        Schema::dropIfExists('rkh_rawat_pupuk');
    }
}
