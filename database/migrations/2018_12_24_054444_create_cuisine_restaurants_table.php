<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuisineRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuisine_restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('restaurant_id');
            $table->unsignedInteger('cuisine_id');
            $table->timestamps();

            $table->unique(['restaurant_id', 'cuisine_id']);

            $table->foreign('cuisine_id')->references('id')->on('cuisines');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuisine_restaurants');
    }
}
