<?php


namespace App\Repositories;


interface CapsuleRepositoryInterface
{
    public function getAllCapsules();
    public function save($data);
}
