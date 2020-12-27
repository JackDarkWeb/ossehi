<?php

namespace App\Providers;

use App\Helpers\AuthHelperFacade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('Auth', function($app){
            return new AuthHelperFacade();
        });
    }
}
