<?php

namespace Tests;

use App\Models\User;
use DateTime;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\ClientRepository;

class PassportTestCase  extends TestCase
{
    use DatabaseTransactions;

    protected $headers = [];
    protected $user;

    /**
     * set up function to get JWT with passport and add headers Bearer Auth
     *
     * @return void
     */
    public function setUp() : void
    {
        parent::setUp();

        $clientRepository = new ClientRepository();
        $client = $clientRepository->createPersonalAccessClient(
            null,
            'Test Personal Access Client',
            'localhost',
        );

        DB::table('oauth_personal_access_clients')->insert([
            'client_id' => $client->id,
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
        ]);

        $this->user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('example')
        ]);

        $token = $this->user->createToken('authToken')->accessToken;
        $this->headers['Accept'] = 'application/json';
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }

}
