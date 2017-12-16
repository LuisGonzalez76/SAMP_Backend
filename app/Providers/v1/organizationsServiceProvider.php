<?php

namespace App\Providers\v1;


use App\Services\v1\organizationsService;
use Illuminate\Support\ServiceProvider;

class organizationsServiceProvider extends ServiceProvider
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
        $this->app->bind(organizationsService::class,function($app){
            return new organizationsService();
        });
    }
}
