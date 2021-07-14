<?php


namespace App\Repositories\Eloquent;

use App\Events\syncCompletedEvent;
use App\Events\syncStartedEvent;
use App\Models\Capsule;
use App\Repositories\CapsuleRepositoryInterface;
use App\Services\MissionService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\Exception;


class CapsuleRepository extends BaseRepository implements CapsuleRepositoryInterface
{
    protected $capsule;
    protected $missionService;

    public function __construct(Capsule $model, Capsule $capsule, MissionService $missionService)
    {
        $this->capsule = $capsule;
        $this->missionService = $missionService;
        parent::__construct($model);
    }

    public function save($data)
    {

        $capsule = new $this->capsule;
        $capsule->capsule_serial = $data['capsule_serial'];
        $capsule->capsule_id = $data['capsule_id'];
        $capsule->status = $data['status'];
        $capsule->original_launch = $data['original_launch'];
        $capsule->original_launch_unix = $data['original_launch_unix'];
        $capsule->landings = $data['landings'];
        $capsule->type = $data['type'];
        $capsule->details = $data['details'];
        $capsule->reuse_count = $data['reuse_count'];
        $capsule->save();
        return $capsule->fresh();

    }

    public function getAllCapsules()
    {
        event(new syncStartedEvent());
        try {
            DB::transaction(function () {
                $client = new client();

                $request = $client->get('https://api.spacexdata.com/v3/capsules');
                $decoded_data = json_decode($request->getBody(), true, 512, JSON_THROW_ON_ERROR);

                foreach ($decoded_data as $key => $val) {

                    $created_obj = $this->save($val);
                    if (is_array($val)) {

                        foreach ($val['missions'] as $item) {
                            $this->missionService->saveMissionData($item, $created_obj->id);
                        }
                    }
                }
                event(new syncCompletedEvent($decoded_data));
            });
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

}
