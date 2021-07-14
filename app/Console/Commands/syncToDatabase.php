<?php

namespace App\Console\Commands;

use App\Services\CapsuleService;
use Illuminate\Console\Command;

class syncToDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:ToDatabase';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get all data from SpaceX API and sync them into the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $capsuleService;
    public function __construct(CapsuleService $capsuleService)
    {
        $this->capsuleService = $capsuleService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->capsuleService->getAll();
        $this->line('Command Worked');
    }
}
