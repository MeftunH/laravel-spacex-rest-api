<?php


namespace App\Repositories\Eloquent;


use App\Models\Mission;
use App\Repositories\MissionRepositoryInterface;

class MissionRepository extends BaseRepository implements MissionRepositoryInterface
{
    protected $mission;
    public function __construct(Mission $model,Mission $mission)
    {
        $this->mission = $mission;
        parent::__construct($model);
    }

    public function save($data,$capsule_id)
    {
        $mission = new $this->mission;
        $mission->name = $data['name'];
        $mission->flight = $data['flight'];
        $mission->capsule_id = $capsule_id;
        $mission->save();
        return $mission->fresh();
    }

}
