<?php

namespace App\Providers;

use App\Services\Contracts\RedisServiceContract;
use App\Services\RedisService;
use Illuminate\Support\ServiceProvider;

class RedisServiceProvider extends ServiceProvider
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
        $this->app->bind(RedisServiceContract::class, RedisService::class);
    }
}
