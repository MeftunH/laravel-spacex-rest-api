<?php


namespace App\Services;


use App\Repositories\Eloquent\MissionRepository;
use Illuminate\Support\Facades\Validator;
class MissionService
{
    protected $missionRepository;
    public function __construct(MissionRepository $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function saveMissionData($data,$capsule_id)
    {
        $validate = Validator::make($data,[
            'name'=>'required|max:255',
            'flight'=>'required|max:255',
        ]);
        if ($validate->fails())
        {
            $validate->messages();
        }
        return $this->missionRepository->save($data,$capsule_id);
    }

}
