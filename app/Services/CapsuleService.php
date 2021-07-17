<?php


namespace App\Services;


use App\Repositories\Eloquent\CapsuleRepository;
use InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

class CapsuleService
{
    protected $capsuleRepository;
    public function __construct(CapsuleRepository $capsuleRepository)
    {
        $this->capsuleRepository = $capsuleRepository;
    }

    public function capsuleDetail($capsule_serial)
    {
        return $this->capsuleRepository->capsuleDetail($capsule_serial);
    }

    public function getRandomCapsule()
    {
        return $this->capsuleRepository->getRandomCapsule();
    }
    public function saveCapsuleData($data)
    {
        $validate = Validator::make($data,[
            'capsule_serial'=>'required|max:255|unique:capsules',
            'capsule_id'=>'required|max:255',
            'status'=>'required',
            'landings'=>'required',
            'type'=>'required|max:255',
            'reuse_count'=>'required|max:10',
        ]);
        if ($validate->fails())
        {
            throw new InvalidArgumentException([$validate->errors()->first()]);
        }
        return $this->capsuleRepository->save($data);
    }

    public function listAll()
    {
        return $this->capsuleRepository->listAllCapsules();
    }
    public function count()
    {
        return $this->capsuleRepository->count();
    }
    public function getAll()
    {
        return $this->capsuleRepository->getAllCapsules();
    }
}
