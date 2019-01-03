<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
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
        app()->singleton('comment', function () {
            return new \App\Providers\ApiProviders\CommentApiProvider;
        });
    }
}
