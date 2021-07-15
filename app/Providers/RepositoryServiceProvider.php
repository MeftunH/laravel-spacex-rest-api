<?php

namespace App\Providers;

use App\Repositories\CapsuleRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\CapsuleRepository;
use App\Repositories\Eloquent\MissionRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\MissionRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
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
       $this->app->bind(CapsuleRepositoryInterface::class,CapsuleRepository::class);
       $this->app->bind(MissionRepositoryInterface::class,MissionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
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
