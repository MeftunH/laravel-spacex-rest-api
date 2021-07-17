<?php


namespace App\Services;


use App\Repositories\Eloquent\UserRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

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
    public function saveUserData($data)
    {
        $validate = Validator::make($data,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 401);
        }

        return $this->userRepository->save($data);
    }
}
