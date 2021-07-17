<?php


namespace App\Repositories;


use App\Http\Resources\UserCollection;

interface UserRepositoryInterface
{
    public function all(): UserCollection;
    public function getFirst();
    public function save($data);
}
