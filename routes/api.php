<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CapsuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::get('capsules', [CapsuleController::class, 'listCapsules'])->name('listCapsules');
    Route::get('capsules/{capsule_serial}', [CapsuleController::class, 'capsuleDetail'])->name('capsuleDetail');

});
