<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFruitlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2020_11_17_081417_create_palm_harvesting_table.php
        Schema::create('palms_harvesting', function (Blueprint $table) {
=======
        Schema::create('fruit_lists', function (Blueprint $table) {
>>>>>>> rkh-maintain:database/migrations/2020_11_16_124807_create_fruitlist_table.php
            $table->id();
            $table->string('name');
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
<<<<<<< HEAD:database/migrations/2020_11_17_081417_create_palm_harvesting_table.php
        Schema::dropIfExists('palms_harvesting');
=======
        Schema::dropIfExists('fruit_lists');
>>>>>>> rkh-maintain:database/migrations/2020_11_16_124807_create_fruitlist_table.php
    }
}
