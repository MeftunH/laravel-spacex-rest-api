<?php


namespace App\Services;


use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserService
{
    protected $userRepository;
    public function __construct(UserRepository  $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all(): \App\Http\Resources\UserCollection
    {
        return $this->userRepository->all();
    }
}
