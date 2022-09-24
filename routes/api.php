<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\controllers\Api\ { AbsensiController,AuthController,UserController };

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

Route::post("/login",[AuthController::class,"login"]);

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix('v1')->group(function() {
        Route::post('/absensi',[AbsensiController::class,"absensi"]);
        Route::post('/profile',[UserController::class,"profile"]);
        Route::post("/absensi",[AbsensiController::class,"absensi"]);
    });
});
   
