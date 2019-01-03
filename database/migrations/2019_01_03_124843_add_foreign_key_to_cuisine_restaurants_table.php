<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToCuisineRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cuisine_restaurants', function (Blueprint $table) {
            $table->foreign('restaurant_id','cuisine_id')->references('id','id')->on('restaurants','cuisines');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cuisine_restuarants', function (Blueprint $table) {
            //
        });
    }
}
