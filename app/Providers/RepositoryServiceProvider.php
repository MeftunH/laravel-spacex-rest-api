<?php

namespace App\Providers;

use App\Repositories\CapsuleRepositoryInterface;
use App\Repositories\MissionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(CapsuleRepositoryInterface::class);
       $this->app->bind(MissionRepositoryInterface::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
