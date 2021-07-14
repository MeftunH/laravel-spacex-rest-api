<?php

namespace App\Listeners;

use App\Events\syncStartedEvent;
use App\Models\Capsule;
use App\Models\Mission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class syncStartedListener
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
     * @param  syncStartedEvent  $event
     * @return void
     */
    public function handle(syncStartedEvent $event)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Capsule::truncate();
        Mission::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Log::info('Successfully Triggered');
    }
}
