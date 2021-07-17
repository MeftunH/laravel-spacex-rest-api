<?php


namespace App\Repositories\Eloquent;


use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $user;
    public function __construct(User $model,User $user)
    {
        $this->user = $user;
        parent::__construct($model);
    }

    public function all(): UserCollection
    {
        return new UserCollection($this->user->all());
    }

    public function getFirst()
    {
        return $this->user->first();
    }


    public function save($data)
    {
      $user = new $this->user;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->createToken('authToken')->accessToken;
        return $user->fresh();
    }
}
