<?php

namespace Tests\Unit;

use App\Models\Capsule;
use App\Models\User;
use App\Services\CapsuleService;
use DateTime;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;
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
    public function setUp(): void
    {
        parent::setUp();
        $this->capsuleService = $this->app->make(CapsuleService::class);
    }
    public function test_authenticated_user_can_user_list(): void
    {
        $response = $this->getJson('/api/users', $this->headers);

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_list_capsules(): void
    {
        $response = $this->getJson( '/api/capsules', $this->headers);
        $response->assertStatus(200);
    }
    public function test_authenticated_user_can_list_filtered_capsules(): void
    {
        $response = $this->getJson( '/api/capsules');
        $capsule = $this->capsuleService->getRandomCapsule();
        $resp_status=200;
        if (isset($capsule)) {
            $response = $this->Json('get', '/api/capsules', ['status' => $capsule->status], $this->headers);
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
}
