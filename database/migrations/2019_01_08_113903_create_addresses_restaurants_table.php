<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses_restaurants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('address_id');
            $table->unsignedInteger('restaurant_id');
            $table->timestamps();

            $table->foreign('address_id')->references('id')->on('addresses');
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
        Schema::dropIfExists('addresses_restaurants');
    }
}
