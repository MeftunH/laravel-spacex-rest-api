<?php

namespace Tests\Feature;

use App\Models\Capsule;
use App\Services\CapsuleService;
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
    protected $capsuleService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
        $this->capsuleService = $this->app->make(CapsuleService::class);
    }

    public function test_can_list_capsules(): void
    {
        $this->withoutMiddleware();
        $response = $this->json('get', route('listCapsules'));
        $response->assertStatus(200)->assertJsonStructure(['status',
            'data' => [
                '*' => [
                    'id',
                    'capsule_serial',
                    'capsule_id',
                    'status',
                    'original_launch',
                    'original_launch_unix',
                    'landings',
                    'type',
                    'details',
                    'reuse_count',
                    'created_at',
                    'updated_at',
                    'missions' => ['*'=>['id', 'name', 'flight', 'capsule_id', 'created_at', 'updated_at'],],
                ],
            ],
        ]);
    }

    public function test_can_filtered_capsules(): void
    {
        $this->withoutMiddleware();
        $capsule = $this->capsuleService->getRandomCapsule();
        $response = $this->call('get',  route('listCapsules', ['status' => $capsule->status]));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'status' => $capsule->status,
            ])->assertJsonStructure(['status',
                'data' => [
                    '*' => [
                        'id',
                        'capsule_serial',
                        'capsule_id',
                        'status',
                        'original_launch',
                        'original_launch_unix',
                        'landings',
                        'type',
                        'details',
                        'reuse_count',
                        'created_at',
                        'updated_at',
                        'missions' => ['*'=>['id', 'name', 'flight', 'capsule_id', 'created_at', 'updated_at'],],
                    ],
                ],
            ]);
    }

    public function test_can_capsule_detail(): void
    {
        $this->withoutMiddleware();
        $capsule = $this->capsuleService->getRandomCapsule();
        $response = $this->call('get', route('capsuleDetail', ['capsule_serial' => $capsule->capsule_serial]));
        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'capsule_serial' => $capsule->capsule_serial,
            ])->assertJsonStructure(['status',
                'data' => [
                    '*' => [
                        'id',
                        'capsule_serial',
                        'capsule_id',
                        'status',
                        'original_launch',
                        'original_launch_unix',
                        'landings',
                        'type',
                        'details',
                        'reuse_count',
                        'created_at',
                        'updated_at',
                        'missions' => ['*'=>['id', 'name', 'flight', 'capsule_id', 'created_at', 'updated_at'],],
                    ],
                ],
            ]);;
    }

    public function test_can_register(): void
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
