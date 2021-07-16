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
       $status_code = 200;
       if (empty(CapsuleRepository::count()))
       {
           $status_code = 400;
       }

       $response->expectsOutput('Command Worked')->assertStatus($status_code);

    }
}
