<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\CapsuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{

    protected $capsuleService;

    public function __construct(CapsuleService $capsuleService)
    {
        $this->capsuleService = $capsuleService;
    }

    /**
     * @OA\Get (
     *     path="/api/sync",
     *     tags={"command"},
     *     summary="Sync To Database",
     *
     *     @OA\Response(response="200", description="Sync To Database", @OA\JsonContent()),
     *     security={
     *         {
     *              "bearerAuth": {},
     *          }
     *     }
     * )
     * @return mixed
     */
    public function sync()
    {
        $status = 500;
        $message = 'Error';
        Artisan::call('sync:ToDatabase');

        if ($this->capsuleService->count())
        {
            $message = 'Command Worked';
            $status = 200;
        }
        return response()->json($status);
    }
}
