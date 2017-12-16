<?php

namespace App\Providers\v1;

use App\Services\v1\facilitiesService;
use Illuminate\Support\ServiceProvider;

class facilitiesServiceProvider extends ServiceProvider
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
        $this->app->bind(facilitiesService::class, function($app){
            return new facilitiesService();
        });
    }
}
