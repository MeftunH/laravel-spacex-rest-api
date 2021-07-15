<?php

namespace Tests;

use App\Models\User;
use DateTime;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;

abstract class PassportTestCase  extends TestCase
{
    use DatabaseTransactions;

    protected $headers = [];
    protected $scopes = [];
    protected $user;

    public function setUp():void
    {
        parent::setUp();
        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null, 'Test Personal Access Client',env('APP_URL')
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        $this->user = factory(User::class)->create();
        $token = $this->user->createToken('TestToken', $this->scopes)->accessToken;
        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer '.$token;
    }
    public function get($uri, array $headers = [])
    {
        return parent::get($uri, array_merge($this->headers, $headers));
    }
}
