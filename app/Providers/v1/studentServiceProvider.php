<?php

namespace App\Providers\v1;

use App\Services\v1\studentService;
use Illuminate\Support\ServiceProvider;

class studentServiceProvider extends ServiceProvider
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
        $this->app->bind(studentService::class, function($app){
            return new studentService();
        });
    }
}
