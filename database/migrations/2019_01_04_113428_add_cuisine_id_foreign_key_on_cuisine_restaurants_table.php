<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCuisineIdForeignKeyOnCuisineRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuisine_restaurants', function (Blueprint $table) {
       //     $table->foreign('cuisine_id')->references('id')->on('cuisines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuisine_restaurants', function (Blueprint $table) {
      //      $table->dropForeign(['cuisine_id']);
        });
    }
}
