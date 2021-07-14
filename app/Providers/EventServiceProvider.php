<?php

namespace App\Providers;

use App\Events\syncCompletedEvent;
use App\Events\syncStartedEvent;
use App\Listeners\syncCompletedListener;
use App\Listeners\syncStartedListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        syncStartedEvent::class =>
            [
                syncStartedListener::class,
            ],
        syncCompletedEvent::class=>
            [  syncCompletedListener::class,],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
