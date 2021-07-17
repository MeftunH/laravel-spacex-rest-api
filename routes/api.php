<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CapsuleController;
use App\Http\Controllers\API\CommandController;
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
Route::post('login', [AuthController::class,'login'])->name('login');
Route::group([
    'middleware' => ['auth:api']
], function () {
    Route::get('/users', [AuthController::class, 'allUsers'])->name('allUsers');
    Route::get('/sync', [CommandController::class, 'sync'])->name('sync');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('capsules')->group(function () {
        Route::get('/', [CapsuleController::class, 'listCapsules'])->name('listCapsules');
        Route::get('/{capsule_serial}', [CapsuleController::class, 'capsuleDetail'])->name('capsuleDetail');
    });

});
