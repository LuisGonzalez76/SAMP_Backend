<?php

namespace App\Providers\v1;

use App\Services\v1\activityService;
use Illuminate\Support\ServiceProvider;

class activityServiceProvider extends ServiceProvider
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
        $this->app->bind(activityService::class, function($app){
            return new activityService();
        });
    }
}
