<?php

namespace Tests\Feature;

use App\Models\Capsule;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EndPointTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    protected $userService;
    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function test_list_capsules(): void
    {
        $this->withoutMiddleware();
        $response = $this->json('get', '/api/capsules');
        $response->assertStatus(200);
    }

    public function test_filtered_capsules()
    {
        $this->withoutMiddleware();
        $capsule = Capsule::with('missions')->inRandomOrder()->first();
        $response = $this->call('get', '/api/capsules',['status' => $capsule->status]);
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'status' => $capsule->status,
            ]);
    }

    public function test_capsule_detail()
    {
        $this->withoutMiddleware();
        $capsule = Capsule::with('missions')->inRandomOrder()->first();
        $response = $this->call('get', '/api/capsules/',['capsule_serial' => $capsule->capsule_serial]);
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'capsule_serial' => $capsule->capsule_serial,
            ]);
    }

    public function test_can_register()
    {
        $this->withoutMiddleware();

        $faker = \Faker\Factory::create();
        $input = [
            'name' => $faker->name,
            'email' => $faker->safeEmail,
            'password' => 'password',
            'password_confirmation' => 'password'
        ];
        $user = $this->userService->saveUserData($input);
        $response = $this->post('/api/register', $input);

        $response
            ->assertStatus(200);


        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
    }
}
