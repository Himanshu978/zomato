<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RestaurantServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton('restaurant', function () {
            return new \App\Tasks\RestaurantAPIProvider;
        });

        app()->singleton('food', function () {
            return new \App\Tasks\FoodAPIProvider;
        });
    }
}
