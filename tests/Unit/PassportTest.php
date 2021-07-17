<?php

namespace Tests\Unit;

use App\Models\Capsule;
use App\Models\User;
use App\Services\CapsuleService;
use App\Services\UserService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
use Laravel\Passport\Passport;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\PassportTestCase;

class PassportTest extends PassportTestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    protected $scopes = ['restricted-scope'];
    protected $capsuleService;
    protected $userService;
    public function setUp(): void
    {
        parent::setUp();
        $this->capsuleService = $this->app->make(CapsuleService::class);
        $this->userService = $this->app->make(UserService::class);
    }
    public function test_authenticated_user_can_user_list(): void
    {
        $response = $this->getJson(route('allUsers'), $this->headers);

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_list_capsules(): void
    {
        $response = $this->getJson( route('listCapsules'), $this->headers);
        $response->assertStatus(200);
    }
    public function test_authenticated_user_can_list_filtered_capsules(): void
    {
        $response = $this->getJson( route('listCapsules'));
        $capsule = $this->capsuleService->getRandomCapsule();
        $resp_status=200;
        if (isset($capsule)) {
            $response = $this->Json('get', route('listCapsules'), ['status' => $capsule->status], $this->headers);
        }
        else
        {
            $resp_status = 401;
        }
        $response
            ->assertStatus($resp_status)
            ->assertJsonFragment([
                'status' => $capsule->status,
            ]);
    }
    public function test_can_login(): void
    {

        $body = [
            'email' => 'swagger@gmail.com',
            'password' => 'swagger@gmail.com'
        ];
        $this->json('POST','/api/login',$body,['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['success'=>['token','user'=>['id','name','email','email_verified_at','created_at','updated_at']]]);
    }

    public function test_authenticated_user_can_logout(): void
    {
        $body = [
            'email' => 'swagger@gmail.com',
            'password' => 'swagger@gmail.com'
        ];
        $user =$this->userService->getFirst();
                Passport::actingAs($user);
        $response = $this->json('POST', route('logout'), [
            'email'=> $user->email,
            'password' => $user->password
        ])->assertStatus(200);

    }
}
