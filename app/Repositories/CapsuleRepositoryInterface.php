<?php


namespace App\Repositories;


interface CapsuleRepositoryInterface
{
    public function getAllCapsules();
    public function listAllCapsules();
    public function save($data);
    public function capsuleDetail($capsule_serial);
    public function getRandomCapsule();
}
