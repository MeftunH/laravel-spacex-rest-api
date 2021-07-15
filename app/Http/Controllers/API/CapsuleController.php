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


    /**
     * @OA\Get (
     *     path="/api/capsules",
     *     tags={"capsule"},
     *     summary="List Capsules",
     *     @OA\Parameter(
     *          name="status",
     *          description="status",
     *          required=false,
     *          in="query",
     *       @OA\Schema(
     *           type="string"
     *      )
     *      ),
     *
     *     @OA\Response(response="200", description="Display a listing of capsules.", @OA\JsonContent()),
     *     security={
     *         {
     *              "bearerAuth": {},
     *          }
     *     }
     * )
     * @return mixed
     */
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

    /**
     * @OA\Get (
     *     path="/api/capsules/{capsule_serial}",
     *      tags={"capsule"},
     *     @OA\Parameter(
     *          name="capsule_serial",
     *          description="Capsule Serial",
     *          required=true,
     *          in="path",
     *      ),
     *     @OA\Response(response="200", description="Display a capsules.", @OA\JsonContent()),
     *     security={
     *         {
     *              "bearerAuth": {},
     *          }
     *     }
     * )
     * @param  \App\Models\Capsule  $capsule
     * @return mixed
     */
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
