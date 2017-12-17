<?php

namespace App\Providers\v1;

use App\Services\v1\userService;
use Illuminate\Support\ServiceProvider;

class userServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(userService::class, function($app){
            return new userService();
        });
    }
}
