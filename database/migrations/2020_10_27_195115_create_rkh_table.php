<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRkhTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rkh', function (Blueprint $table) {
            $table->id();

            $table->foreignId('area_id')->constrained('area');
            $table->foreignId('md1_id')->constrained('md1');
            $table->foreignId('md2_id')->constrained('md2');
            $table->char('pekerjaan');
            // 1: Rawat
            // 2: Panen
            $table->integer('luas');
            $table->integer('populasi');
            $table->date('tanggal_tanam');
            $table->integer('jumlah_karyawan');
            $table->timestamps();
        });

        /* 
            Mandor 1 input
            1. Afdelling 
            2. Blok
            3. Luas
            4. Populasi
            5. Tahun tanam
            7. Nama mandor 2
            8. Pekerjaan (panen / rawat)
            9. Jumlah karyawan
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rkh');
    }
}
