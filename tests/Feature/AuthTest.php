<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @group apilogintests
     */
    public function testApiLogin() {

        $body = [
            'email' => 'swagger@gmail.com',
            'password' => 'swagger@gmail.com'
        ];
        $this->json('POST','/api/login',$body,['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(['success'=>['token','user'=>['id','name','email','email_verified_at','created_at','updated_at']]]);
    }
    /**
     * @group apilogintests
     */

}
