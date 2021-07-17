<?php

namespace Tests\Feature;

use App\Repositories\Eloquent\CapsuleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class CommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_command()
    {
       $response = $this->artisan('sync:ToDatabase');
       $status_code = 0;
       if (empty($this->count()))
       {
           $status_code = 1;
       }

       $response->expectsOutput('Command Worked')->assertExitCode($status_code);


    }
}
