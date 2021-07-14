<?php

namespace App\Listeners;

use App\Events\syncCompletedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

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
     * @param syncCompletedEvent $event
     * @return void
     * @throws \JsonException
     */
    public function handle(syncCompletedEvent $event)
    {
        Log::info('Sync is done');
        Log::info(json_encode($event->context, JSON_THROW_ON_ERROR));

    }
}
