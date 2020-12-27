<?php

namespace App\Providers;

use App\Services\Contracts\ResetPasswordServiceContract;
use App\Services\ResetPasswordService;
use Illuminate\Support\ServiceProvider;

class ResetPasswordServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ResetPasswordServiceContract::class, ResetPasswordService::class);
    }
}
