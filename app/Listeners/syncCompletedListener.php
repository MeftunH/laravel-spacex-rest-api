<?php

namespace App\Listeners;

use App\Events\syncCompletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class syncCompletedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  syncCompletedEvent  $event
     * @return void
     */
    public function handle(syncCompletedEvent $event)
    {
        //
    }
}
