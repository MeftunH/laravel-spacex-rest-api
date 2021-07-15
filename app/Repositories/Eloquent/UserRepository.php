<?php


namespace App\Repositories\Eloquent;


use App\Http\Resources\UserCollection;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;

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
}
