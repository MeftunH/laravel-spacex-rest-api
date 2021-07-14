<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CapsuleService;
use Exception;

class CapsuleController extends Controller
{
    protected $capsuleService;

    public function __construct(CapsuleService $capsuleService)
    {
        $this->capsuleService = $capsuleService;
    }

    public function store($arr): \Illuminate\Http\JsonResponse
    {
        $data = $arr->only([
            'capsule_serial',
            'capsule_id',
            'status',
            'original_launch',
            'original_launch_unix',
            'landings',
            'type',
            'details',
            'reuse_count',
        ]);
        $res = ['status' => 200];
        try {
            $res['data'] = $this->capsuleService->saveCapsuleData($data);
        } catch (Exception $e) {
            $res = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($res['status']);
    }

    public function listCapsules()
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->capsuleService->listAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    public function capsuleDetail($capsule_serial)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->capsuleService->capsuleDetail($capsule_serial);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

}
